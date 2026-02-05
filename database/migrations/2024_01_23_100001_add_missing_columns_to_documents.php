<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'service_request_id')) {
                $table->foreignId('service_request_id')->nullable()->after('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('documents', 'file_name')) {
                $table->string('file_name')->after('service_request_id');
            }
            if (!Schema::hasColumn('documents', 'file_path')) {
                $table->string('file_path')->after('file_name');
            }
            if (!Schema::hasColumn('documents', 'file_type')) {
                $table->string('file_type')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('documents', 'file_size')) {
                $table->integer('file_size')->nullable()->after('file_type');
            }
            if (!Schema::hasColumn('documents', 'status')) {
                $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->after('file_size');
            }
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['service_request_id']);
            $table->dropColumn(['service_request_id', 'file_name', 'file_path', 'file_type', 'file_size', 'status']);
        });
    }
};