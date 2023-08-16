<?php

declare(strict_types=1);

use App\Constants\ItemTypeConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ItemTypeConstants::ITEM_TYPES);
            $table->string('name');
            $table->string('rarity');
            $table->integer('level');
            $table->integer('attack');
            $table->integer('defence');
            $table->integer('health');
            $table->integer('speed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
