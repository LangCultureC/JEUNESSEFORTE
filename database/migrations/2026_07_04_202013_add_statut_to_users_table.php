
<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

    public function up(): void

    {

        Schema::table('users', function (Blueprint $table) {

            $table->string('statut')->default('actif')->after('role'); // actif | en_attente | refuse

            $table->string('role_souhaite')->nullable()->after('statut'); // pair-aidant | psychologue

        });

    }

    public function down(): void

    {

        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn(['statut', 'role_souhaite']);

        });

    }

};

