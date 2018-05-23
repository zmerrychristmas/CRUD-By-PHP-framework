<?php

namespace App\Repositories;

use App\Models\Classes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ClassRepository
 * @package App\Repositories
 * @version May 22, 2018, 9:10 am UTC
 *
 * @method Class findWithoutFail($id, $columns = ['*'])
 * @method Class find($id, $columns = ['*'])
 * @method Class first($columns = ['*'])
*/
class ClassRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Classes::class;
    }
}
