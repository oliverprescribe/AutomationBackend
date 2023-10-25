<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('suffix', 255)->nullable();
            $table->string('user_code', 255)->nullable()->unique();
            $table->string('position', 255)->nullable();
            $table->string('job_limit', 255);
            $table->string('user_level', 255);
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->boolean('adaptation')->default(true);
            $table->string('username', 255)->unique();
            $table->unsignedBigInteger('vendor_organizations_id')->nullable();
            $table->boolean('is_vendor')->default(false);
            $table->longText('preferences')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
