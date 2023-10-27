<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_criteria', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 5, 2);
            $table->integer('criterion');
            $table->timestamps();
        });

        $data = [
            ['score' => 60, 'criterion' => 100],
            ['score' => 80, 'criterion' => 200],
            ['score' => 91, 'criterion' => 300],
            ['score' => 100, 'criterion' => 500],
        ];

        DB::table('test_criteria')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_criteria');
    }
};
