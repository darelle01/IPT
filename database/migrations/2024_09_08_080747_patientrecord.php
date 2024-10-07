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
        Schema::create('patientrecord', function (Blueprint $table) {
            $table->id();                                                                               
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();    
            $table->timestamps();
        
            $table->string('PatientID')->unique();

            $table->string('LastName');
            $table->string('FirstName');
            $table->string('MiddleName');

            $table->date('Birthdate');
            $table->integer('Age');
            $table->string('Gender');

            $table->string('HouseNumber');
            $table->string('Street');
            $table->string('Barangay');
            $table->string('Municipality');
            $table->string('Province');
        
            $table->string('ContactNumber');
            $table->string('email')->unique();
            
            $table->string('PhilhealthNumber')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patientrecord');
    }
};
