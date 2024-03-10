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
        Schema::table('teams', function (Blueprint $table) {
            $table->boolean('slack_enabled')->default(false);
            $table->string('slack_client_id')->nullable();
            $table->string('slack_team_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('slack_enabled');
            $table->dropColumn('slack_client_id');
            $table->dropColumn('slack_team_id');
        });
    }
};
