<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class person
 * @package App\Models
 * @version May 22, 2018, 9:57 am UTC
 *
 * @property string name
 * @property integer age
 */
class person extends Model
{
    use SoftDeletes;

    public $table = 'people';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'age'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'age' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
