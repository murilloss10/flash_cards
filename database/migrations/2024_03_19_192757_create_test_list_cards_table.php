<?php

use App\Models\Card;
use App\Models\TestList;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_list_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TestList::class);
            $table->foreignIdFor(Card::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_list_cards');
    }
};
