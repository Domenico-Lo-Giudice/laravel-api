<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Type;
use App\Models\Tech;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $types = Type::orderBy('label')->get();
        $teches = Tech::orderBy('label')->get();
        $project_teches = [];
        return view('admin.projects.create', compact('project', 'types', 'teches', 'project_teches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'type_id' => 'nullable|exists:types,id',
            'teches' => 'nullable|exists:teches,id',

        ]);


        $data = $request->all();

        if(Arr::exists($data, 'image')) {
            $path = Storage::put('upload/projects', $data['image']);
            $data['image'] = $path;

        }   


        $project = new Project;
        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        
        if(Arr::exists($data, 'teches')) $project->teches()->attach($data['teches']);

        return to_route('admin.projects.show', $project);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $types = Type::orderBy('label')->get();
        $teches = Tech::orderBy('label')->get();
        $project_teches = $project->teches->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'types', 'teches', 'project_teches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'type_id' => 'nullable|exists:types,id',
            'teches' => 'nullable|exists:teches,id',
        ]);

        $data = $request->all();

        if(Arr::exists($data, 'image')) {
            $path = Storage::put('upload/projects', $data['image']);
            $data['image'] = $path;

        }   


        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        $project->update($data);
        if(Arr::exists($data, 'teches')) 
             $project->teches()->sync($data['teches']);
        else 
            $project->teches()->detach();

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index');
    }
}
