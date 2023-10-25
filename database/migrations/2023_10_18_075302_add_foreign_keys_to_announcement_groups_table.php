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
        Schema::table('announcement_groups', function (Blueprint $table) {
            $table->foreign(['announcement_id'])->references(['id'])->on('announcements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::table('announcement_groups', function (Blueprint $table) {
            $table->dropForeign('announcement_groups_announcement_id_foreign');
            $table->dropForeign('announcement_groups_group_id_foreign');
        });
    }
};
