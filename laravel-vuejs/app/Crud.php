<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Crud extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'color'
    ];

    protected $table = 'crud';

}
