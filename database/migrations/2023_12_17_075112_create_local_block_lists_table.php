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
        Schema::create('local_block_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('rt');
            $table->string('statement')->unique();
            $table->string('hiddenBy');

            $table->date('dateofreceivedMessage');
            $table->string('index');
            $table->string('notes')->nullable();
            $table->integer('statu')->default(0);
            //0  default
            //1 freez
            $table->string('file_name')->nullable();

            $table->timestamp('created_at')->useCurrent(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_block_lists');
    }
};
