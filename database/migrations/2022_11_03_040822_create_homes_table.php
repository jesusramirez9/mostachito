<?php

use App\Models\Home;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('url_yt');
            $table->string('filepdf');
            $table->string('image');
            $table->string('image2');
            $table->string('image3');
            $table->string('image4');

            $table->enum('status',[Home::BORRADOR, Home::PUBLICADO])->default(Home::BORRADOR);
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
        Schema::dropIfExists('homes');
    }
}
