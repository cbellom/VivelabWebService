<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserSignUp extends Model
{
  protected $table = 'user_sign_ups';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id', 'name', 'lastname', 'email', 'phone' , 'post-id' , 'post-name'];
}
