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
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('message');
            }

            if (!Schema::hasColumn('contact_messages', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }

            if (!Schema::hasColumn('contact_messages', 'referrer')) {
                $table->string('referrer')->nullable()->after('user_agent');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            if (Schema::hasColumn('contact_messages', 'referrer')) {
                $table->dropColumn('referrer');
            }

            if (Schema::hasColumn('contact_messages', 'user_agent')) {
                $table->dropColumn('user_agent');
            }

            if (Schema::hasColumn('contact_messages', 'ip_address')) {
                $table->dropColumn('ip_address');
            }
        });
    }
};
