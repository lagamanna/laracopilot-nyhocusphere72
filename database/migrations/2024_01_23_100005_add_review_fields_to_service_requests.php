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
        
        if ($driver === 'sqlite' && Schema::hasTable('service_requests')) {
            // For SQLite, recreate table with new columns
            Schema::create('service_requests_new', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('service_type_id')->constrained()->onDelete('cascade');
                $table->string('title')->nullable();
                $table->text('description');
                $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
                $table->enum('contact_method', ['email', 'phone', 'both'])->default('email');
                $table->string('location')->nullable();
                $table->text('notes')->nullable();
                $table->enum('status', ['pending', 'approved', 'rejected', 'in_progress', 'completed', 'cancelled'])->default('pending');
                $table->text('admin_comment')->nullable();
                $table->timestamp('reviewed_at')->nullable();
                $table->string('reviewed_by')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
            });
            
            // Copy data
            $columns = Schema::getColumnListing('service_requests');
            $selectColumns = array_intersect($columns, [
                'id', 'user_id', 'service_type_id', 'title', 'description',
                'priority', 'contact_method', 'location', 'notes', 'status',
                'created_at', 'updated_at'
            ]);
            
            if (!empty($selectColumns)) {
                DB::statement('INSERT INTO service_requests_new (' . implode(',', $selectColumns) . ') 
                              SELECT ' . implode(',', $selectColumns) . ' FROM service_requests');
            }
            
            Schema::dropIfExists('service_requests');
            Schema::rename('service_requests_new', 'service_requests');
        } else {
            Schema::table('service_requests', function (Blueprint $table) {
                if (!Schema::hasColumn('service_requests', 'admin_comment')) {
                    $table->text('admin_comment')->nullable();
                }
                if (!Schema::hasColumn('service_requests', 'reviewed_at')) {
                    $table->timestamp('reviewed_at')->nullable();
                }
                if (!Schema::hasColumn('service_requests', 'reviewed_by')) {
                    $table->string('reviewed_by')->nullable();
                }
                if (!Schema::hasColumn('service_requests', 'completed_at')) {
                    $table->timestamp('completed_at')->nullable();
                }
            });
        }
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['admin_comment', 'reviewed_at', 'reviewed_by', 'completed_at']);
        });
    }
};