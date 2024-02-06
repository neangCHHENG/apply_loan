<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_amount');
            $table->string('monthly_income');
            $table->string('purpose_loan');
            $table->string('loan_year');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('marital_status');
            $table->string('date_birth');
            $table->string('number_dependents');
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('province');
            $table->string('city');
            $table->string('country');
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
        Schema::dropIfExists('apply_loans');
    }
}
