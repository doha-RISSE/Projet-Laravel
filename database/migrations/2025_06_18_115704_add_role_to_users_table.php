<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Cette ligne ajoute une colonne "role" de type texte (string) dans la table "users"
        // La valeur par défaut sera "user"
        // La colonne sera placée juste après la colonne "password"
        $table->string('role')->default('user')->after('password');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Cette ligne supprime la colonne "role" si tu décides d'annuler cette migration
        $table->dropColumn('role');
    });
}

};
