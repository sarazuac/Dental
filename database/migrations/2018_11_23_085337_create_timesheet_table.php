<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      
            Schema::create('timesheets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('user_id');
                $table->timestamp('clocked_in_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('lunch_in_at')->nullable();
                $table->timestamp('lunch_out_at')->nullable();
                $table->timestamp('clocked_out_at')->nullable();
                $table->tinyInteger('marked_for_review')->default(0);
                
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('timesheets');
    }
}
