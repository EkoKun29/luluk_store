<?php

use App\Models\NoRekening;
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
        Schema::create('receivable_payment_transfers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('receivable_payment_id')->constrained();
            $table->foreignIdFor(NoRekening::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivable_payment_transfers');
    }
};
