<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToBorrowBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borrow_books', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('book_id'); // Thêm cột quantity, mặc định là 1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borrow_books', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Xóa cột quantity khi rollback
        });
    }
}

