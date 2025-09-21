<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) { $table->id(); $table->string('title'); $table->timestamps(); });
        Schema::create('fields', function (Blueprint $table) { $table->id(); $table->foreignId('form_id')->constrained('forms')->onDelete('cascade'); $table->string('label'); $table->string('type'); $table->json('options')->nullable(); $table->boolean('is_required')->default(false); $table->integer('order')->default(0); $table->timestamps(); });
        Schema::create('submissions', function (Blueprint $table) { $table->id(); $table->foreignId('form_id')->constrained('forms')->onDelete('cascade'); $table->uuid('uuid')->unique(); $table->json('data')->nullable(); $table->timestamps(); });
    }
    public function down(){ Schema::dropIfExists('submissions'); Schema::dropIfExists('fields'); Schema::dropIfExists('forms'); }
}
