<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('judul');
            $table->string('slug');
            $table->integer('id_kategori');
            $table->text('deskripsi');
            $table->integer('stok');
            $table->integer('harga');
            $table->text('foto1');
            $table->text('foto2');
            $table->text('foto3');
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
        Schema::dropIfExists('barang');
    }
}
