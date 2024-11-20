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
        Schema::create('monobank_payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceId')->unique();
            $table->string('status');
            $table->unsignedInteger('amount');
            $table->string('reference')->nullable();
            $table->string('destination')->nullable();
            $table->timestamps();
        });
    }


};
