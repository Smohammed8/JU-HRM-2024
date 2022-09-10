<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('acronym', 100)->unique();
            $table->string('email', 255)->nullable();
            $table->string('telephone', 255)->nullable();
            $table->string('extension_line', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->foreignId('seal')->nullable()->constrained('upload_files');
            $table->foreignId('teter')->nullable()->constrained('upload_files');
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('objective')->nullable();
            $table->string('building_number', 255)->nullable();
            $table->string('office_number', 255)->nullable();
            $table->text('motto')->nullable();
            $table->text('value_list')->nullable();
            $table->foreignId('parent_unit_id')->nullable()->constrained('units');
            $table->foreignId('reports_to_id')->nullable()->constrained('units');
            $table->foreignId('organization_id')->constrained();
            $table->integer('chair_man_type_id')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
