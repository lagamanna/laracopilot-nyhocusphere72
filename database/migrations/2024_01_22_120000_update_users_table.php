<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15)->after('email');
            $table->string('pin')->after('password');
            $table->text('address')->after('pin');
            $table->string('email_verification_token')->nullable()->after('address');
            $table->timestamp('email_verified_at')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'pin', 'address', 'email_verification_token']);
        });
    }
};