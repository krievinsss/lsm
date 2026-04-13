<?php

namespace Database\Seeders;

use App\Models\Guide;
use App\Models\User;
use App\Services\ApiKeyService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $apiKeyService = app(ApiKeyService::class);
        $apiKeyResult = $apiKeyService->create($user, 'Default key');

        $this->command->info('Admin user code: ' . $admin->user_code);
        $this->command->info('User user code: ' . $user->user_code);
        $this->command->info('User API key: ' . $apiKeyResult['plainTextKey']);

        $this->seedGuides();
    }

    protected function seedGuides(): void
    {
        $today = now()->startOfDay();
        $tomorrow = $today->copy()->addDay();

        $channelSchedules = [
            1 => [
                [$today->copy()->setTime(5, 0, 0), 40, 'Nakts ziņas'],
                [$today->copy()->setTime(6, 0, 0), 30, 'Rīta panorāma'],
                [$today->copy()->setTime(6, 30, 20), 25, 'Laika ziņas'],
                [$today->copy()->setTime(7, 0, 0), 60, 'Rīta intervija'],
                [$today->copy()->setTime(12, 30, 0), 20, 'Dienas ziņas'],
                [$today->copy()->setTime(13, 20, 0), 16, 'Panorāma 2'],
                [$today->copy()->setTime(13, 36, 0), 19, 'Šodienas jautājums'],
                [$today->copy()->setTime(13, 55, 10), 7, 'Sporta ziņas'],
                [$today->copy()->setTime(20, 0, 0), 36, 'Panorāma'],
                [$today->copy()->setTime(20, 37, 0), 19, 'Šodienas jautājums'],
                [$today->copy()->setTime(20, 56, 10), 6, 'Sporta ziņas'],
                [$tomorrow->copy()->setTime(1, 15, 0), 45, 'Nakts kino'],
                [$tomorrow->copy()->setTime(5, 0, 0), 30, 'Agrais rīts'],
                [$tomorrow->copy()->setTime(6, 0, 0), 30, 'Jaunā TV diena'],
            ],
            2 => [
                [$today->copy()->setTime(6, 0, 0), 50, 'Rīta šovs'],
                [$today->copy()->setTime(6, 50, 30), 30, 'Mūzikas pauze'],
                [$today->copy()->setTime(8, 0, 0), 90, 'Dokumentālā filma'],
                [$today->copy()->setTime(14, 0, 0), 30, 'Ziņu apskats'],
                [$today->copy()->setTime(18, 0, 0), 120, 'Vakara filma'],
                [$today->copy()->setTime(20, 5, 0), 25, 'Intervija'],
            ],
            3 => [
                [$today->copy()->setTime(6, 0, 0), 20, 'Bērnu rīts'],
                [$today->copy()->setTime(6, 20, 15), 40, 'Animācijas seriāls'],
                [$today->copy()->setTime(10, 0, 0), 60, 'Ceļojumu raidījums'],
                [$today->copy()->setTime(13, 0, 0), 45, 'Virtuves stāsti'],
                [$today->copy()->setTime(19, 0, 0), 30, 'Vakara ziņas'],
                [$today->copy()->setTime(19, 31, 0), 90, 'Lielā filma'],
            ],
        ];

        foreach ($channelSchedules as $channelNr => $entries) {
            foreach ($entries as [$startsAt, $durationMinutes, $title]) {
                Guide::create([
                    'title' => $title,
                    'channel_nr' => $channelNr,
                    'starts_at' => $startsAt->copy(),
                    'ends_at' => $startsAt->copy()->addMinutes($durationMinutes),
                ]);
            }
        }
    }
}