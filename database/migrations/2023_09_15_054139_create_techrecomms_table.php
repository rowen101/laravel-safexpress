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
        Schema::create('techrecomms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recommnum',20);
            $table->string('company',20);
            $table->string('branch',20);
            $table->string('department',20);
            $table->string('warehouse');
            $table->string('user',20);
            $table->text('promblem');
            $table->text('udetails')->nullable();
            $table->text('assconducted');
            $table->text('recommendation');
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('techrecomms');
    }
};
