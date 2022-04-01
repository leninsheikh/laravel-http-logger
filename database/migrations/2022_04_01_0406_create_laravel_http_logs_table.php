<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAPILogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_http_logs', function (Blueprint $table) {
            $table->id();
            $table->string('key', 150);
            $table->string('name', 60);
            $table->string('url', 200);
            $table->string('method', 10);
            $table->json('request_body')->nullable();
            $table->json('request_header')->nullable();
            $table->integer('response_status')->nullable();
            $table->json('response_body')->nullable();
            $table->json('response_header')->nullable();
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
        Schema::dropIfExists('laravel_http_logs');
    }
}
