<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('service_requests', 'title')) {
                $table->string('title')->after('service_type_id');
            }
            if (!Schema::hasColumn('service_requests', 'priority')) {
                $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal')->after('description');
            }
            if (!Schema::hasColumn('service_requests', 'contact_method')) {
                $table->enum('contact_method', ['email', 'phone', 'both'])->default('email')->after('priority');
            }
            if (!Schema::hasColumn('service_requests', 'notes')) {
                $table->text('notes')->nullable()->after('contact_method');
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['title', 'priority', 'contact_method', 'notes']);
        });
    }
};