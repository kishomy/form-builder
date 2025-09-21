<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Field extends Model { protected $fillable = ['form_id','label','type','options','is_required','order']; protected $casts=['options'=>'array','is_required'=>'boolean']; public function form(){return $this->belongsTo(Form::class);} }
