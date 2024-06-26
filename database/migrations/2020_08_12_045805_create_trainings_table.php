<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trainings', function (Blueprint $table){
            $table->id();
            $table->integer('trainer_option');
            $table->integer('training_type');
            $table->integer('trainer');
            $table->float('training_cost',15,2)->default(0.00);
            $table->integer('employee');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->integer('performance')->default(0);
            $table->integer('status')->default(0);
            $table->text('remarks')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
