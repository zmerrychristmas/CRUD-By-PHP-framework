<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Class
 * @package App\Models
 * @version May 22, 2018, 9:10 am UTC
 *
 * @property varchar name
 */
class Classes extends Model
{
    use SoftDeletes;

    public $table = 'classes';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => '200'
    ];


}
