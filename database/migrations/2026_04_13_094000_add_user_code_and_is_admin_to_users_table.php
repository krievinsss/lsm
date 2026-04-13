<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_code', 6)->nullable()->after('id');
            $table->boolean('is_admin')->default(false)->after('password');
        });

        User::query()
            ->whereNull('user_code')
            ->orderBy('id')
            ->chunkById(100, function ($users) {
                foreach ($users as $user) {
                    do {
                        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                    } while (
                        User::query()->where('user_code', $code)->exists()
                    );

                    $user->forceFill([
                        'user_code' => $code,
                    ])->save();
                }
            });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('user_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['user_code']);
            $table->dropColumn(['user_code', 'is_admin']);
        });
    }
};