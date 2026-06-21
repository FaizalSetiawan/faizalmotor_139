<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('created_at', 'products_created_at_index');
            $table->index('price', 'products_price_index');
            $table->index(['motor_model_id', 'created_at'], 'products_model_created_at_index');
        });

        Schema::table('sirines', function (Blueprint $table) {
            $table->index('created_at', 'sirines_created_at_index');
            $table->index('price', 'sirines_price_index');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_created_at_index');
            $table->dropIndex('products_price_index');
            $table->dropIndex('products_model_created_at_index');
        });

        Schema::table('sirines', function (Blueprint $table) {
            $table->dropIndex('sirines_created_at_index');
            $table->dropIndex('sirines_price_index');
        });
    }
};
