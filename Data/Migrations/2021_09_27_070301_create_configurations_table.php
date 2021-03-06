<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            if (config('uuider.installed', false)) {
                $table->uuid('id')->primary('id');
                $table->nullableUuidMorphs('configurable');
            } else {
                $table->increments('id')->primary('id');
                $table->nullableMorphs('configuration');
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
        Schema::dropIfExists('configurations');
    }
}
