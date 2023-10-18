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
        Schema::create('b_directors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('image')->nullable();
            $table->string('position', 150);
            $table->text('about')->nullable();
            $table->string('org_type',20)->nullable();
            $table->boolean('is_social')->default(true)->nullable();
            $table->boolean('fb')->default(false)->nullable();
            $table->boolean('tw')->default(false)->nullable();
            $table->boolean('linkin')->default(false)->nullable();
            $table->boolean('instagram')->default(false)->nullable();
            $table->string('fb_url')->nullable();
            $table->string('tw_url')->nullable();
            $table->string('linkin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_directors');
    }
};
