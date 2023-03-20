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
        Schema::create('profil', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('profil');
            $table->text('alamat');
            $table->String('telp');
            $table->String('email');
            $table->String('whatsapp');
            $table->String('link_whatsapp');
            $table->String('link_facebook');
            $table->String('link_instagram');
            $table->String('link_youtube');
            $table->String('link_embed');
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
        Schema::dropIfExists('profiles');
    }
};
