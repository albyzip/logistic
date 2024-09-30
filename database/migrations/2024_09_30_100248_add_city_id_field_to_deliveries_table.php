<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->foreignId('city_id')
                ->index()
                ->constrained('cities');
        });
    }

    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            //
        });
    }
};
