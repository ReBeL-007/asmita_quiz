<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_groups', function (Blueprint $table) {
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('group_id');

         //FOREIGN KEY CONSTRAINTS
           $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
           $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

         //SETTING THE PRIMARY KEYS
           $table->primary(['admin_id','group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_groups');
    }
}
