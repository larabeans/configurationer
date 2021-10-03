<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            if(config('uuider.installed', false)) {
                $table->uuid('id')->primary('id');
            } else {
                $table->increments('id')->primary('id');
            }
            $table->uuidMorphs('configurable');
            $table->string('configuration');

            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
}
