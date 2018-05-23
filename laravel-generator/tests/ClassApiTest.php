<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClassApiTest extends TestCase
{
    use MakeClassTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateClass()
    {
        $class = $this->fakeClassData();
        $this->json('POST', '/api/v1/classes', $class);

        $this->assertApiResponse($class);
    }

    /**
     * @test
     */
    public function testReadClass()
    {
        $class = $this->makeClass();
        $this->json('GET', '/api/v1/classes/'.$class->id);

        $this->assertApiResponse($class->toArray());
    }

    /**
     * @test
     */
    public function testUpdateClass()
    {
        $class = $this->makeClass();
        $editedClass = $this->fakeClassData();

        $this->json('PUT', '/api/v1/classes/'.$class->id, $editedClass);

        $this->assertApiResponse($editedClass);
    }

    /**
     * @test
     */
    public function testDeleteClass()
    {
        $class = $this->makeClass();
        $this->json('DELETE', '/api/v1/classes/'.$class->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/classes/'.$class->id);

        $this->assertResponseStatus(404);
    }
}
