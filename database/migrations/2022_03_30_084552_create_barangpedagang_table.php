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
        Schema::create('barang_pedagang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('desk_barang');
            $table->integer('harga_barang');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->foreignId('id_barang');
            $table->foreignId('id_kategori');
            $table->foreignId('id_satuan');
            $table->foreignId('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
