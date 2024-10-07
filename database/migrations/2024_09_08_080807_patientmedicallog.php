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
        Schema::create('patientmedicallog',function (Blueprint $table){
            $table->id();                                                                               
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();    
            $table->timestamps();
            $table->string('Consultation');
            $table->string('Remarks')->nullable();
            $table->date('DateOfConsultation');
            $table->date('DateOfUpload');
            $table->text('Files')->nullable();
            $table->string('PatientNumber');

            $table->foreign('PatientNumber')
                  ->references('PatientID')
                  ->on('patientrecord')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
