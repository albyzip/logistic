<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('box_sizes', function (Blueprint $table) {
            $table->unsignedInteger('height');
            $table->unsignedInteger('width');
            $table->unsignedInteger('length');
        });
    }

    public function down(): void
    {
        Schema::table('box_sizes', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('width');
            $table->dropColumn('length');
        });
    }
};
