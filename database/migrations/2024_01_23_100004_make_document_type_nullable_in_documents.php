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
        if ($driver === 'sqlite' && Schema::hasTable('documents')) {
            // Create temporary table with correct schema
            Schema::create('documents_temp', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('service_request_id')->nullable()->constrained()->onDelete('cascade');
                $table->string('document_type')->nullable();
                $table->string('file_name');
                $table->string('file_path');
                $table->string('file_type')->nullable();
                $table->integer('file_size')->nullable();
                $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
                $table->timestamp('verified_at')->nullable();
                $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
            
            // Copy existing data
            $columns = Schema::getColumnListing('documents');
            $selectColumns = array_intersect($columns, [
                'id', 'user_id', 'service_request_id', 'document_type', 'file_name', 
                'file_path', 'file_type', 'file_size', 'status', 'verified_at', 
                'verified_by', 'notes', 'created_at', 'updated_at'
            ]);
            
            if (!empty($selectColumns)) {
                DB::statement('INSERT INTO documents_temp (' . implode(',', $selectColumns) . ') 
                              SELECT ' . implode(',', $selectColumns) . ' FROM documents');
            }
            
            // Drop old table
            Schema::dropIfExists('documents');
            
            // Rename temp table to documents
            Schema::rename('documents_temp', 'documents');
        } else if ($driver !== 'sqlite') {
            // For MySQL/PostgreSQL, we can modify the column directly
            Schema::table('documents', function (Blueprint $table) {
                if (Schema::hasColumn('documents', 'document_type')) {
                    $table->string('document_type')->nullable()->change();
                }
            });
        }
    }

    public function down()
    {
        // No need to reverse this migration as it's a fix
    }
};