<?php

namespace App\Repositories;

use App\Models\person;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class personRepository
 * @package App\Repositories
 * @version May 22, 2018, 9:57 am UTC
 *
 * @method person findWithoutFail($id, $columns = ['*'])
 * @method person find($id, $columns = ['*'])
 * @method person first($columns = ['*'])
*/
class personRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'age'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return person::class;
    }
}
