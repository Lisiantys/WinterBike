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
        Schema::disableForeignKeyConstraints();

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 75);
            $table->string('image_path');
            $table->date('beginningDate')->useCurrent();
            $table->date('endDate')->nullable();
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('description', 2048);
            $table->string('staffMessage')->nullable();
            $table->boolean('is_validated')->default(0);
            $table->timestamps();
            $table->unsignedTinyInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedTinyInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedTinyInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
