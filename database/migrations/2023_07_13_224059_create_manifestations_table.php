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
        Schema::create('manifestations', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('type');
            $table->string('status');
            $table->double('lat', 8, 8);
            $table->double('lon', 8, 8);
            $table->timestamp('finished_at');
            $table->timestamps();
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('department_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifestations');
    }
};
