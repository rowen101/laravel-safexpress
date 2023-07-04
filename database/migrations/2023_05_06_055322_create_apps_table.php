<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_code', 20); // application code
            $table->string('app_name', 150); // name of the application
            $table->text('description'); //Describe the product
            $table->string('app_icon', 150)->nullable(); //application icon
            $table->boolean('status')->default(true); //ACTIVE,INACTIVE,MAINTENANCE
            $table->string('status_message',150)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 50)->index()->nullable();
            $table->integer('app_id')->unsigned();
            $table->foreign('app_id')->references('id')->on('app');
            $table->string('menu_code', 20)->default('NONE')->index();
            $table->string('menu_title', 100)->index();
            $table->string('description', 255);
            $table->integer('parent_id')->default(0);
            $table->string('menu_icon')->nullable();
            $table->string('menu_route', 50)->deafault('default')->index()->nullable(); // url
            $table->integer('sort_order')->default(100);
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


        //app menu permission
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('core_menu');
            $table->string('permission_code', 50);
            $table->string('description', 150)->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        //adding core_role
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_code', 150);
            $table->string('description', 150)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
          //adding core_user
          Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->date('password_change_date')->nullable();
            $table->string('user_type', 20)->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('role');
            $table->string('first_name', 150)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->integer('is_change_password')->default(0);
            $table->string('last_ip_address', 255)->nullable();
            $table->string('last_session_id', 255)->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->integer('incorrect_logins')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('language', 5)->default('EN'); //core_vdd_language
            $table->boolean('is_active')->default(true);
            $table->string('google_id')->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


        Artisan::call('db:seed');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('role');
        Schema::dropIfExists('users');
        Schema::dropIfExists('permission');
    }
};
