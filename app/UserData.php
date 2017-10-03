<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    public $table = "users_data";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'birth', 'email', 'phone',
    ];

    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
