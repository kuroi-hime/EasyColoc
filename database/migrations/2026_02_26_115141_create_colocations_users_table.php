<?php

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
        Schema::create('colocations_users', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('colocation_id')->constrained('colocations', 'id_colocation');
            $table->string('role')->default('membre');
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamp('left_at')->nullable();
            $table->primary(['user_id', 'colocation_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colocations_users');
    }
};
