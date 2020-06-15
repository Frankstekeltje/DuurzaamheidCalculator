<?php

namespace App\Http\Controllers;

use App\Material;

class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('cms', [
            'materials' => Material::orderBy('type')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cmsCreate', [
            'types' => Material::distinct()->get(['type'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
        request()->validate([
            'naam' => 'required|max:255',
            'type' => 'required',
            'waarde' => 'required|numeric'
        ]);

        $materiaal = new Material();

        $materiaal->name = request('naam');
        $materiaal->type = request('type');
        $materiaal->value = request('waarde');

        $materiaal->save();

        return redirect('./cms');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        if(Material::where('id', '=', $id)->exists()){
            return view('cmsEdit', [
                'types' => Material::distinct()->get(['type']),
                'material' => Material::where('id', '=', $id)->get()
            ]);
        }else{
            return redirect('./cms');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
        request()->validate([
            'naam' => 'required|max:255',
            'type' => 'required',
            'waarde' => 'required|numeric'
        ]);

        $materiaal = Material::find($id);

        $materiaal->name = request('naam');
        $materiaal->type = request('type');
        $materiaal->value = request('waarde');

        $materiaal->save();

        return redirect('./cms');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $materiaal = Material::find($id);

        $materiaal->forceDelete();

        return redirect('./cms');
    }
}
