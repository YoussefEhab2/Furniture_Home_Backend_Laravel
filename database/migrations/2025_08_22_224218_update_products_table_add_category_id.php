<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {

            if (Schema::hasColumn('product', 'category')) {
                $table->dropColumn('category');
            }
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->dropForeign(['category_id']);
        });
    }

};