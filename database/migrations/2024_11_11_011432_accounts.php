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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();                                                                               
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();    
            $table->timestamps();
        
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
        
            $table->string('email')->unique();
            $table->string('ContactNumber');
            
            $table->string('Position');
            $table->string('Status');
            $table->string('ActivityStatus');
            
            $table->string('username')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();

           
            $table->string('OTP')->nullable(); 
            $table->timestamp('OTPduration')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
