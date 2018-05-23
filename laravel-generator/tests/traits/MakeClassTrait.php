<?php

use Faker\Factory as Faker;
use App\Models\Class;
use App\Repositories\ClassRepository;

trait MakeClassTrait
{
    /**
     * Create fake instance of Class and save it in database
     *
     * @param array $classFields
     * @return Class
     */
    public function makeClass($classFields = [])
    {
        /** @var ClassRepository $classRepo */
        $classRepo = App::make(ClassRepository::class);
        $theme = $this->fakeClassData($classFields);
        return $classRepo->create($theme);
    }

    /**
     * Get fake instance of Class
     *
     * @param array $classFields
     * @return Class
     */
    public function fakeClass($classFields = [])
    {
        return new Class($this->fakeClassData($classFields));
    }

    /**
     * Get fake data of Class
     *
     * @param array $postFields
     * @return array
     */
    public function fakeClassData($classFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'name' => $fake->word
        ], $classFields);
    }
}
