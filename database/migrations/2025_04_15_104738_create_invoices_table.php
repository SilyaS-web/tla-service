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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('amount');
            $table->string('type')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('incoming_invoice_url')->nullable();
            $table->timestamp('due_date');
            $table->string('account_number');
            $table->string('payer_name');
            $table->string('payer_inn');
            $table->string('payer_kpp')->nullable();
            $table->string('items')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
