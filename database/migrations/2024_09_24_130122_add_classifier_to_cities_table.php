<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('classifier')->default(\App\Enums\CityClassifier::NONE->value);
        });
    }

    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            //
        });
    }
};
