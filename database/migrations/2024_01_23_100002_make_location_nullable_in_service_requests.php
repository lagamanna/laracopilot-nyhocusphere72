<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Check if location column exists before modifying
            if (Schema::hasColumn('service_requests', 'location')) {
                // SQLite doesn't support modifying columns directly
                // We need to handle this differently for SQLite vs other databases
                $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();
                
                if ($driver === 'sqlite') {
                    // For SQLite, we can't modify the column directly
                    // The column will be made nullable through recreation if needed
                    // Or we can just ensure it has a default value
                } else {
                    // For MySQL/PostgreSQL, we can modify the column
                    $table->string('location')->nullable()->change();
                }
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();
            
            if ($driver !== 'sqlite' && Schema::hasColumn('service_requests', 'location')) {
                $table->string('location')->nullable(false)->change();
            }
        });
    }
};