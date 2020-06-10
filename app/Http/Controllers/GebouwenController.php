<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gebouw;
use App\Material;
use Mockery\Undefined;

class GebouwenController extends Controller
{
    public function show(){
        //render a single resource
    }

    public function index(){
        //render a list of the resource
    }

    public function create($type = ""){
        //Shows a view to create a new resource

        switch($type){
            case "muur":
                return view('muur', [
                    'materials' => Material::all()
                ]);
                break;
            case "plafond":
                return view('plafond', [
                    'materials' => Material::where('type', '!=', 'glas')
                                            ->where('type', '!=', 'Luchtspouw')
                                            ->get()
                ]);
                break;
            case "vloer":
                return view('vloer', [
                    'materials' => Material::where('type', '!=', 'glas')
                                            ->where('type', '!=', 'Luchtspouw')
                                            ->get()
                ]);
                break;
            case "":
                return view('calculator', [
                    'gebouwen' => Gebouw::all()
                ]);
                break;
        }
    }

    public function store($type){
        //Save the created resource
        request()->validate([
            'select.*' => 'required',
            'dikte.*' => 'required',
            'naam' => 'required',
            'type' => 'required'
        ]);

        $value = 0;
        $matArr = request('select');
        $dikteArr = request('dikte');

        for($i = 0; $i < count($matArr); $i++){
            $material = Material::find($matArr[$i]);
            if($material->type == "glas" || $material->type == "Luchtspouw") $value += $material->value;
            else $value += ($dikteArr[$i] / $material->value);
        }

        $saveString = "";

        for($i = 0; $i < count($matArr); $i++){
            $saveString .= $matArr[$i] . ":" . $dikteArr[$i] . ";";
        }

        $gebouw = new Gebouw();
        $gebouw->name = request('naam');
        $gebouw->type = request('type');
        $gebouw->value = $value;
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');

    }

    public function edit(){
        //Shows the edit resource
    }

    public function update(){
        //Save the edited resource
    }

    public function destroy(){
        //Delete the resource
    }
}
