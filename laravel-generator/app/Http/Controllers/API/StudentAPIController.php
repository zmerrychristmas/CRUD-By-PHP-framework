<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentAPIRequest;
use App\Http\Requests\API\UpdateStudentAPIRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StudentController
 * @package App\Http\Controllers\API
 */

class StudentAPIController extends AppBaseController
{
    /** @var  StudentRepository */
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     * GET|HEAD /students
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->studentRepository->pushCriteria(new RequestCriteria($request));
        $this->studentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $students = $this->studentRepository->all();

        return $this->sendResponse($students->toArray(), 'Students retrieved successfully');
    }

    /**
     * Store a newly created Student in storage.
     * POST /students
     *
     * @param CreateStudentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentAPIRequest $request)
    {
        $input = $request->all();

        $students = $this->studentRepository->create($input);

        return $this->sendResponse($students->toArray(), 'Student saved successfully');
    }

    /**
     * Display the specified Student.
     * GET|HEAD /students/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        return $this->sendResponse($student->toArray(), 'Student retrieved successfully');
    }

    /**
     * Update the specified Student in storage.
     * PUT/PATCH /students/{id}
     *
     * @param  int $id
     * @param UpdateStudentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student = $this->studentRepository->update($input, $id);

        return $this->sendResponse($student->toArray(), 'Student updated successfully');
    }

    /**
     * Remove the specified Student from storage.
     * DELETE /students/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student->delete();

        return $this->sendResponse($id, 'Student deleted successfully');
    }
}
