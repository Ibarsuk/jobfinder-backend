<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('experience');
            $table->string('position', 100);
            $table->string('photo')->nullable();
            $table->boolean('active')->default(0);
            $table->string('city')->nullable();
            $table->timestamp('relevant_at')->useCurrent();
            $table->string('portfolio', 100)->nullable();
            $table->timestamps();
            $table->string('text', 2000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
};
