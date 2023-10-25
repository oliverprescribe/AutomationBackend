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
        Schema::table('group_department', function (Blueprint $table) {
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['group_id'])->references(['id'])->on('groups')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_department', function (Blueprint $table) {
            $table->dropForeign('group_department_department_id_foreign');
            $table->dropForeign('group_department_group_id_foreign');
        });
    }
};
