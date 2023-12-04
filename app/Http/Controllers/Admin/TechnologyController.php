<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use Illuminate\Support\Str;
use App\Functions\Helper;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderBy('id', 'desc')->paginate(5);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // prima di creare una nuova tecnologia controllo se esiste già
        // se esiste non creo la nuova tecnologia ma ritorno all'index con messaggio di errore
        $exists = Technology::where('name', $request->name)->first();

        if($exists){
            return redirect()->route('admin.technologies.index')->with('error', 'Tecnologia già presente');
        }else{
            $new_technology = new Technology();
            $new_technology->name = $request->name;
            $new_technology->slug = Str::slug($request->name, '-');
            $new_technology->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia inserita con successo');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        // Valido il dato
        // Controllo se esiste già una tecnologia con lo stesso nome
        // Genero lo slug
        // Effettuo l'update
        // Reinderizzo all'index

        $val_data = $request->validate([
            'name' => 'required|min:2|max:50'
        ], [
            'name.required' => 'Devi inserire il nome della tecnologia',
            'name.min' => 'Il nome della tecnologia deve avere almeno :min caratteri',
            'name.max' => 'Il nome della tecnologia non deve avere più di :max caratteri'
        ]);

        $exists = Technology::where('name', $request->name)->first();

        if($exists){
            return redirect()->route('admin.technologies.index')->with('error', 'Tecnologia già presente');
        }

        $val_data['slug'] = Helper::generateSlug($request->name, Technology::class);
        $technology->update($val_data);

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia aggiornata con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia eliminata con successo');
    }
}
