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
        Schema::create('usermenus', function (Blueprint $table) {

            $table->integer('user_id')->nullable();
            $table->integer('menu_id')->nullable();
            $table->string('flag')->nullable();
            $table->boolean('caninsert')->nullable();
            $table->boolean('candelete')->nullable();
            $table->boolean('canedit')->nullable();
            $table->boolean('canview')->nullable();
            $table->string('favorites')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usermenus');
    }
};
