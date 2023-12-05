<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('id', 'desc')->paginate(5);
        return view('admin.types.index', compact('types'));
    }

    public function typeProject(){
        $types = Type::all();
        return view('admin.types.type-project', compact('types'));
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
        // prima di creare un nuov tipo controllo se esiste già
        // se esiste non creo il nuovo tipo ma ritorno all'index con messaggio di errore
        $exists = Type::where('name', $request->name)->first();

        if($exists){
            return redirect()->route('admin.types.index')->with('error', 'Tipo già presente');
        }else{
            $new_type = new Type();
            $new_type->name = $request->name;
            $new_type->slug = Str::slug($request->name, '-');
            $new_type->save();

            return redirect()->route('admin.types.index')->with('success', 'Tipo inserito con successo');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipo eliminato con successo');
    }
}
