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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('cascade');
            $table->string('hero_image');
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->text('meta_title');
            $table->text('meta_description');
            $table->boolean('published')->default(false);
            $table->boolean('in_menu')->default(true);
            $table->dateTime('published_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
