<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_storage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('path');
            $table->string('filename');
            $table->string('type', 50)->nullable();
            $table->unsignedInteger('size');
            $table->enum('storage_location', ['local', 'aws_s3', 'digitalocean', 'wasabi', 'minio'])->default('local');
            $table->timestamps();

            $table->foreign('company_id', 'file_storage_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_storage');
    }
}
