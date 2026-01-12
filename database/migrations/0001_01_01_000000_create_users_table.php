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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 191);
            $table->string('name', 191);
            $table->string('image', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->tinyInteger('group')->comment('Superadmin, Organik, Non-Organik, Mitra, PIC Mitra');
            $table->rememberToken();
            $table->tinyInteger('status')->default('10');
            $table->tinyInteger('is_send_whatsapp')->default('1');
            $table->tinyInteger('is_send_email')->default('1');
            $table->timestamp('last_login')->nullable();
            $table->string('created_by', 191)->nullable();
            $table->string('updated_by', 191)->nullable();
            $table->string('deleted_by', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('one_time_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type', 191)->nullable();
            $table->bigInteger('entity_id')->nullable();
            $table->string('code', 191);
            $table->string('email', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('type', 191)->comment('Login, ..etc');
            $table->tinyInteger('is_verified')->default('0');
            $table->timestamp('expiry_time');
            $table->string('created_by', 191)->nullable();
            $table->string('updated_by', 191)->nullable();
            $table->string('deleted_by', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('one_time_passwords');
        Schema::dropIfExists('sessions');
    }
};
