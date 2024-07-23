<?php

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

        Schema::create('pastes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('content');
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            $table->foreignId('syntax_id')->constrained('syntax')->onDelete('cascade');
            $table->string('tags')->nullable();
            $table->foreignId('rights_id')->constrained('rights')->onDelete('cascade');
            $table->integer('complaints')->default(0);
            $table->timestamp('access_time')->nullable();
            $table->string('short_url')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastes');
    }
};
