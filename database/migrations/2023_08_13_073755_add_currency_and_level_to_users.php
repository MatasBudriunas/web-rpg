<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('current_xp')->default(0)->after('password');
            $table->integer('needed_xp')->default(10)->after('current_xp');
            $table->integer('level')->default(1)->after('needed_xp');
            $table->integer('currency')->default(0)->after('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['current_xp', 'needed_xp', 'level', 'currency']);
        });
    }
};
