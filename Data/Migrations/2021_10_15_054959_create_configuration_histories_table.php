<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuration_histories', function (Blueprint $table) {
            if (config('uuider.installed', false)) {
                $table->uuid('id')->primary('id');
                $table->uuid('configuration_id');
            } else {
                $table->increments('id')->primary('id');
                $table->foreignId('configuration_id');
            }
            $table->text('configuration');

            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_histories');
    }
}
