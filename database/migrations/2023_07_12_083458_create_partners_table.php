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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->text('name');
			$table->text('description');
			$table->string('logo');
            $table->text('video_url')->nullable();
            $table->text('file')->nullable();
            $table->integer('price_rate');
            $table->double('start_price');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->boolean('start_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
