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
        DB::table('statuses')->insert([
            ['name' => 'pendiente'],
            ['name' => 'confirmada'],
            ['name' => 'cancelada'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('statuses')->whereIn('name', ['pendiente', 'confirmada', 'cancelada'])->delete();
    }
};
