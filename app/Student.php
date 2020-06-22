<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Student extends Model
{
  protected $primaryKey = 'student_id';
  protected $guarded =[];
  

  public function client()
  {
    return $this->belongsTo(User::class,'user_id');
  }
}
