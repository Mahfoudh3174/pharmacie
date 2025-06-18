<?php

use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid")->unique();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Pharmacy::class)->constrained()->cascadeOnDelete();
            $table->date("date");
            $table->decimal("amount", 10, 2);
            $table->enum("status", ["pending", "validated", "rejected"])->default("pending");
            $table->text("reject_reason")->nullable();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('uuid');
            $table->index('status');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
