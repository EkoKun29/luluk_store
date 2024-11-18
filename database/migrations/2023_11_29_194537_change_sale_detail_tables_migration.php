<?php

use App\Models\ProductPrice;
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
        Schema::table('sale_details', function(Blueprint $table){
            $table->dropForeign('sale_details_product_id_foreign');
            $table->dropColumn('product_id');
            $table->dropColumn('price');
            $table->foreignUuid('product_price_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_details', function(Blueprint $table){
            $table->foreignUuid('product_id')->constrained();
            $table->integer('price');
            $table->dropColumn('product_price_id');
        });
    }
};
