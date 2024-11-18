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
        Schema::create('debt_payment_transfers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('debt_payment_id')->constrained();
            $table->foreignIdFor(NoRekening::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debt_payment_transfers');
    }
};
