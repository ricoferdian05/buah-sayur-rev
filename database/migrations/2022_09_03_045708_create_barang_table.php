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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('slug')->unique();
            $table->integer('harga_pasok');
            $table->string('persentase');
            $table->timestamp('published_at')->nullable();
            $table->boolean('status_musim')->default(false);
            $table->boolean('peminat')->default(false);
            $table->foreignId('id_kategori');
            $table->foreignId('id_satuan');
            $table->foreignId('id_user');
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
        Schema::dropIfExists('suppliers');
    }
};
