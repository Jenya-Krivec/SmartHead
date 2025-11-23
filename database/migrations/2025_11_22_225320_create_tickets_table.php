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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->index();
            $table->string('subject', 255)->default('');
            $table->text('text');
            $table->boolean('is_incoming')->default(true);
            $table->enum('status', ['new', 'in progress', 'processed'])->default('new');
            $table->dateTime('response_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
