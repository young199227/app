<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            //自動編號
            $table->increments('id');
            // 設定string型態 長度100 允許空值
            $table->string('title',100)->nullable();
            // 設定text型態
            $table->text('content')->nullable();
            // 設定日期間型態 default:預設值 CURRENT_TIMESTAMP 寫入當下時間
            // $table->dateTime('createDate')->default('CURRENT_TIMESTAMP');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test');
    }
};
