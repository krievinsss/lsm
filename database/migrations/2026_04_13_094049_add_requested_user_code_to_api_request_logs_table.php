<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('api_request_logs', function (Blueprint $table) {
            $table->string('requested_user_code', 6)->nullable()->after('api_key_id');
            $table->index('requested_user_code');
        });
    }

    public function down(): void
    {
        Schema::table('api_request_logs', function (Blueprint $table) {
            $table->dropIndex(['requested_user_code']);
            $table->dropColumn('requested_user_code');
        });
    }
};