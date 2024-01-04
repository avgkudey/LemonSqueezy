<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'lemon_squeezy_id',
                'trial_ends_at',
            ]);
        });
    }
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('lemon_squeezy_id')->nullable()->unique();
            $table->timestamp('trial_ends_at')->nullable();
        });
    }
};
