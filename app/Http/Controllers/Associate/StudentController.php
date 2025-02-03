<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiService;

class StudentController extends Controller
{
    /** @var ApiService */
    var $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = $this->apiService->getAssociateProfile();

        if ($profile->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $profile = $profile['data'] ?? null;

        $response = $this->apiService->getAssociateStudents(['page' => request()->input('page')]);
        $students = $response['data'];

        if (request()->ajax()) {
            return response()->json($students);
        }


        return view('associate.pages.students.index', compact('students', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = $this->apiService->getAssociateProfile();

        if ($profile->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $profile = $profile['data'] ?? null;

        return view('associate.pages.students.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->apiService->postAssociateStudent($request->input());

        if ($response->clientError()) {
            abort(500);
        }

        if (request()->ajax()) {
            $response = $response['data'] ?? null;

            return response()->json($response);
        }

        return redirect(route('associate.students.index'))->with('created', 'Student successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->apiService->getAssociateProfile();

        if ($profile->status() == 401) {
            return redirect('/' . '?login=true');
        }

        $profile = $profile['data'] ?? null;

        $response = $this->apiService->getAssociateStudent($id);

        $student = $response['data'] ?? null;

        return view('associate.pages.students.edit', compact('student', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->apiService->putAssociateStudent($request->input(), $id);

        if ($response->serverError() || $response->clientError()) {
            abort(500);
        }

        return redirect(route('associate.students.index'))->with('updated', 'Student successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendVerificationMail()
    {
        $this->apiService->sendStudentVerificationMail(request()->input());

        return redirect(route('associate.students.index'))->with('send', 'Verification mail successfully send');
    }
}
