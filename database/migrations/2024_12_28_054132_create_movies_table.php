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
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->text('synopsis');
            $table->string('poster', 255)->nullable();
            $table->string('year', 8);
            $table->boolean('available')->default(true);
            $table->uuid('genre_id'); 
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    // Hapus kolom 'image' jika migrasi di-rollback
    Schema::table('movies', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
