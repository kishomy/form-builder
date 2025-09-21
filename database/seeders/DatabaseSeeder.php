<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Form;
class DatabaseSeeder extends Seeder { public function run(){ $form = Form::create(['title'=>'Contact Form']); $form->fields()->createMany([ ['label'=>'Name','type'=>'text','is_required'=>true,'order'=>1], ['label'=>'Email','type'=>'text','is_required'=>true,'order'=>2], ['label'=>'Message','type'=>'textarea','is_required'=>false,'order'=>3], ['label'=>'Interests','type'=>'checkbox','options'=>json_encode(['Sports','Music','Art']),'is_required'=>false,'order'=>4] ]); } }
