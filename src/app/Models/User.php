<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'checked', 'description', 'interest',
        'date_of_birth', 'email', 'account'
    ];

    public function cards()
    {
        return $this->hasMany('App\Models\Card', 'user_id');
    }

    public function userCount($processedFileId)
    {
        return static::where('processed_file_id', $processedFileId)->count();
    }

    public function setDateOfBirthAttribute($value)
    {
        if (strpos($value, '/') !== false) {
            $date = Carbon::createFromFormat('d/m/Y', $value);
            $this->attributes['date_of_birth'] = $date->toDateTimeString();
        } else {
            $date = Carbon::parse($value);
            $this->attributes['date_of_birth'] = $date->toDateTimeString();
        }
    }
}
