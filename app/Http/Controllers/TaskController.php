<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $tasks = Task::whereTripId($id)
            ->with('Collaborator')
            //->with('Trip')
            ->get()->toArray();

        $collaborator = Collaborator::whereTripId($id)
            ->with('Tasks')
            // ->with(['Tasks' => function($q) {
            //     $q->where('tasks.collaborator_id', '=', 'collaborators.user_id');
            // }])
            //->with('Trip')
            ->get()->toArray();

        //print_r($tasks['collaborator']);
        //dd($collaborator);
        // dd($tasks);
        return view('planner.tasks',
            [
                'tasks' => $tasks,
                'section' => 'create-trip'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
