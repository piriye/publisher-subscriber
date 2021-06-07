<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'url' ];

    public function topics()
    {
        return $this->belongsToMany('App\Models\Topic');
    }
}
