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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('genre')->nullable();
            $table->string('name');
            $table->bigInteger('duration');
            $table->string('country')->nullable();
            $table->date('release_date')->nullable();
            $table->longText('description');
            $table->integer('seasons')->default(0);
            $table->longText('url');
            $table->longText('poster');
            $table->float('imdb_rating')->default(0);
            $table->float('rotten_tomatoes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
