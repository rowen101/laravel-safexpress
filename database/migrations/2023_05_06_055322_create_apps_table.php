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
            $table->boolean('is_active')->default(true)->nullable(); //ACTIVE,INACTIVE,MAINTENANCE
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
            $table->string('description', 255)->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('menu_icon')->nullable();
            $table->string('menu_route', 50)->deafault('default')->index()->nullable(); // url
            $table->integer('sort_order')->default(100)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


        //app menu permission
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
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
            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
          //adding core_user
          Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
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
            $table->boolean('is_active')->default(true)->nullable();
            $table->string('google_id')->nullable();
            $table->integer('created_by')->default(0)->nullable();
            $table->integer('updated_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('gurec')->nullable();
            $table->string('foldername')->nullable();
            $table->string('filename', 100)->index()->nullable();
            $table->string('image')->nullable();
            $table->string('caption', 225)->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('sort')->default(100)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable(0);
            $table->timestamps();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region');
            $table->string('site');
            $table->string('sitehead')->nullable();
            $table->string('location')->nullable();
            $table->text('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('geomap')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('body');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->integer('created_by')->default(0);
            $table->boolean('is_publish')->default(false)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('website')->nullable();
            $table->text('comment');
            $table->unsignedBigInteger('posts_id');
            $table->boolean('is_publish')->default(true)->nullable();
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id');
            $table->text('content');
            $table->timestamps();

            // Define foreign key constraint for the comment_id column
            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');
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
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('replies');
    }
};
