<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Submission extends Model { protected $fillable = ['form_id','uuid','data']; protected $casts = ['data'=>'array']; public function form(){return $this->belongsTo(Form::class);} }
