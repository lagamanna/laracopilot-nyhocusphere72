<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();
        
        // Only run this for SQLite
        if ($driver === 'sqlite') {
            // Create temporary table with correct schema
            Schema::create('service_requests_temp', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('service_type_id')->constrained()->onDelete('cascade');
                $table->string('title')->nullable();
                $table->text('description');
                $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
                $table->enum('contact_method', ['email', 'phone', 'both'])->default('email');
                $table->text('notes')->nullable();
                $table->enum('status', ['pending', 'approved', 'in_progress', 'completed', 'cancelled'])->default('pending');
                $table->string('location')->nullable();
                $table->timestamps();
            });
            
            // Copy existing data if service_requests table exists
            if (Schema::hasTable('service_requests')) {
                $columns = Schema::getColumnListing('service_requests');
                $selectColumns = array_intersect($columns, [
                    'id', 'user_id', 'service_type_id', 'title', 'description', 
                    'priority', 'contact_method', 'notes', 'status', 'location', 
                    'created_at', 'updated_at'
                ]);
                
                if (!empty($selectColumns)) {
                    DB::statement('INSERT INTO service_requests_temp (' . implode(',', $selectColumns) . ') 
                                  SELECT ' . implode(',', $selectColumns) . ' FROM service_requests');
                }
                
                // Drop old table
                Schema::dropIfExists('service_requests');
            }
            
            // Rename temp table to service_requests
            Schema::rename('service_requests_temp', 'service_requests');
        }
    }

    public function down()
    {
        // No need to reverse this migration as it's a fix
    }
};