<?php

namespace App\Services;

use App\Models\Guide;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GuideService {

    public function getGuideForTvDay(int $channelNr, string $date): Collection
    {
        [$from, $to] = $this->tvDayBounds($date);

        $guides = Guide::query()
            ->where('channel_nr', $channelNr)
            ->where('starts_at', '>=', $from)
            ->where('starts_at', '<', $to)
            ->orderBy('starts_at')
            ->get();

        return $this->withAdjustedEndTimes($guides, $channelNr);
    }

    public function getOnAir(int $channelNr): ?Guide
    {
        $now = now();

        $current = Guide::query()
            ->where('channel_nr', $channelNr)
            ->where('starts_at', '<=', $now)
            ->orderByDesc('starts_at')
            ->first();

        if (! $current) {
            return null;
        }

        $adjusted = $this->adjustGuideEndTime($current, $channelNr);

        return $adjusted->starts_at <= $now && $adjusted->ends_at > $now
            ? $adjusted
            : null;
    }

    public function getUpcoming(int $channelNr, int $limit = 10): Collection
    {
        $now = now();

        $currentOrNext = Guide::query()
            ->where('channel_nr', $channelNr)
            ->where(function ($query) use ($now) {
                $query->where('starts_at', '>=', $now)
                    ->orWhere('starts_at', '<=', $now);
            })
            ->orderByRaw('CASE WHEN starts_at <= ? THEN 0 ELSE 1 END', [$now])
            ->orderBy('starts_at')
            ->get();

        $adjusted = $this->withAdjustedEndTimes($currentOrNext, $channelNr)
            ->filter(function (Guide $guide) use ($now) {
                return $guide->starts_at >= $now || ($guide->starts_at <= $now && $guide->ends_at > $now);
            })
            ->sortBy('starts_at')
            ->values()
            ->take($limit);

        return new Collection($adjusted->all());
    }

     public function create(array $data): Guide
    {
        $startsAt = Carbon::parse($data['starts_at']);
        $endsAt = Carbon::parse($data['ends_at']);

        if ($endsAt->lessThanOrEqualTo($startsAt)) {
            throw ValidationException::withMessages([
                'ends_at' => 'Beigu laikam jābūt vēlākam par sākuma laiku.',
            ]);
        }

        $this->ensureNoOverlap(
            (int) $data['channel_nr'],
            $startsAt,
            $endsAt,
        );

        return Guide::create([
            'title' => $data['title'],
            'channel_nr' => $data['channel_nr'],
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);
    }

    public function ensureNoOverlap(int $channelNr, Carbon $startsAt, Carbon $endsAt): void
    {
        $overlapExists = Guide::query()
            ->where('channel_nr', $channelNr)
            ->where(function ($query) use ($startsAt, $endsAt) {
                $query->where('starts_at', '<', $endsAt)
                    ->where('ends_at', '>', $startsAt);
            })
            ->exists();

        if ($overlapExists) {
            throw ValidationException::withMessages([
                'starts_at' => 'Programmas ieraksts pārklājas ar esošu ierakstu.',
            ]);
        }
    }

    public function tvDayBounds(string $date): array
    {
        $from = Carbon::parse($date . ' 06:00:00');
        $to = (clone $from)->addDay();

        return [$from, $to];
    }

    public function withAdjustedEndTimes(Collection $guides, int $channelNr): Collection
    {
        $guides = $guides->values();

        foreach ($guides as $index => $guide) {
            $nextGuide = $guides->get($index + 1)
                ?? Guide::query()
                    ->where('channel_nr', $channelNr)
                    ->where('starts_at', '>', $guide->starts_at)
                    ->orderBy('starts_at')
                    ->first();

            $guide->setAttribute(
                'adjusted_ends_at',
                $nextGuide ? $nextGuide->starts_at : $guide->ends_at
            );
        }

        return $guides;
    }

    public function adjustGuideEndTime(Guide $guide, int $channelNr): Guide
    {
        $nextGuide = Guide::query()
            ->where('channel_nr', $channelNr)
            ->where('starts_at', '>', $guide->starts_at)
            ->orderBy('starts_at')
            ->first();

        $guide->setAttribute('adjusted_ends_at', $nextGuide ? $nextGuide->starts_at : $guide->ends_at);

        return $guide;
    }
}