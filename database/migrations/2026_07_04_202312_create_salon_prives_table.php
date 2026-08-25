
<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

    public function up(): void

    {

        Schema::create('salon_prives', function (Blueprint $table) {

            $table->id();

            $table->foreignId('jeune_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('pro_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('confession_id')->nullable()->constrained('confessions')->nullOnDelete();

            $table->timestamps();

        });

    }

    public function down(): void

    {

        Schema::dropIfExists('salon_prives');

    }

};

