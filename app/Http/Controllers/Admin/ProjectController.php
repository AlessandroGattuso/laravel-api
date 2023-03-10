<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use App\Models\Project;

use App\Models\Type;

use App\Models\Technology;

use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Mail\ConfirmProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all(); 
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Project::generateSlug($request->title);

        if($request->hasFile('cover_image')){
            $path = Storage::disk('public')->put('project_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $newProject = Project::create($data);
        // $newProject = new Project();
        // $newProject->fill($data);
        
        // $newProject->save();
        if($request->has('technologies'))
            $newProject->technologies()->attach($request->technologies);
        
        $newLead = new Lead();
        $newLead->title = $data['title'];
        $newLead->slug = $data['slug'];
        $newLead->description = $data['description'];

        $newLead->save();

        Mail::to('info@laravel.mail.com')->send(new ConfirmProject($newLead));

        return redirect()->route('admin.projects.index')->with('message', 'il progetto ?? stato creato');
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
        $types = Type::all(); 
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $data['slug'] = Project::generateSlug($request->title);

        if($request->hasFile('cover_image')){

            if($project->cover_image)
                Storage::delete($project->cover_image);  
            

            $path = Storage::disk('public')->put('project_images', $request->cover_image); 
            $data['cover_image'] = $path;

        }

        $project->update($data);

        if($request->has('technologies'))
            $project->technologies()->sync($request->technologies);
        else
            $project->technologies()->detach();

    
        return redirect()->route('admin.projects.index')->with('message', 'Modifica al progetto eseguita');
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

        return redirect()->route('admin.projects.index')->with('message','Il progetto ?? stato eliminato correttamente');
    }
}
