<?php

use App\Enums\VaccinationStatus;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->integer('vaccination_status')->default(VaccinationStatus::NOT_VACCINATED);
            $table->foreignId('vaccine_center_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('vaccine_taken_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
