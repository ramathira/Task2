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
        Schema::create('timesheets', function (Blueprint $table) {
           $table->id();
			 $table->string('task_name');
			  $table->date('task_date');
			  $table->Integer('hours');
			   $table->foreignId('user_id')->constrained()->onDelete('cascade');
			   $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		$table->dropForeign('timesheets_user_id_foreign');
		$table->dropIndex('timesheets_user_id_index');
		$table->dropColumn('user_id');
        Schema::dropIfExists('timesheets');
    }
};
