<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Crea un nuovo progetto';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project = null;
        return view('admin.projects.create-edit', compact('title', 'method', 'route', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        $form_data['slug'] = Helper::generateSlug($form_data['name'], Project::class);
        // Se esiste la chiave image salvo l'immagine nel filesystem e nel database
        if(array_key_exists('image', $form_data)){
            // Prima di salvare il file prendo il nome del file per salvarlo nel db
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();

            // Salvo il file nello storage rinominandolo
            $form_data['image'] = Storage::put('uploads', $form_data['image']);
        }

        $new_project = Project::create($form_data);

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $nextProject = Project::where('id', '>', $project->id)->first();
        $prevProject = Project::where('id', '<', $project->id)->orderBy('id', 'desc')->first();
        return view('admin.projects.show', compact('project', 'nextProject', 'prevProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $title = 'Modifica progetto';
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        return view('admin.projects.create-edit', compact('title', 'method', 'route', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if($form_data['name'] !== $project->name){
            $form_data['slug'] = Helper::generateSlug($form_data['name'], Project::class);
        }else{
            $form_data['slug'] = $project->slug;
        }

        if(array_key_exists('image', $form_data)){
            // Se esiste la chiave image vuol dire che devo sostituire l'immagine presente se esiste eliminando quella vecchia
            if($project->image){
                // Se era presente la elimino dallo storage
                Storage::disk('public')->delete($project->image);
            }

            // Prima di salvare il file prendo il nome del file per salvarlo nel db
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();

            // Salvo il file nello storage rinominandolo
            $form_data['image'] = Storage::put('uploads', $form_data['image']);
        }

        $form_data['date'] = date('Y-m-d');

        $project->update($form_data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Se il progetto contiene un immagine la devo eliminare
        if($project->image){
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo');
    }
}
