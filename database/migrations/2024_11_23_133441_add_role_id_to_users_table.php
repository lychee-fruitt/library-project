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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable(); // Thêm trường role_id kiểu unsignedBigInteger (vì role_id là khóa ngoại từ bảng roles)
            $table->foreign('role_id')->references('id')->on('role')->onDelete('set null'); // Định nghĩa khóa ngoại
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); 
            $table->dropColumn('role_id'); 
        });
    }
};
