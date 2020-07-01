<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gebouw;
use App\Material;
use Mockery\Undefined;

class GebouwenController extends Controller
{
    public function show($id){
        //render a single resource
        $gebouw = Gebouw::where('type', 'gebouw')->find($id);
        $ruimtes = Gebouw::where('type', 'ruimte')->get();
        $walls = Gebouw::where('type', 'buitenMuur')
                            ->get();
        $ceilings = Gebouw::where('type', 'plafond')->get();
        $floors = Gebouw::where('type', 'vloer')->get();

        if($gebouw != null){
            return view('gebouwOverzicht', [
                'gebouw' => $gebouw,
                'ruimtes' => $ruimtes,
                'muren' => $walls,
                'plafonds' => $ceilings,
                'vloeren' => $floors
            ]);
        }else{
            return redirect()->action('GebouwenController@indexBuilding');
        }
    }

    public function index(){
        //render a list of the resource
        $gebouwen = Gebouw::paginate(5);

        return view('calculator', [
            'gebouwen' => $gebouwen
        ]);
    }

    public function indexBuilding(){
        $gebouwen = Gebouw::where('type', 'gebouw')->get();

        return view('overzicht', [
            'gebouwen' => $gebouwen
        ]);
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
                    'materials' => Material::all()
                ]);
                break;
            case "vloer":
                return view('vloer', [
                    'materials' => Material::all()
                ]);
                break;
            case "ruimte":
                return view('ruimte', [
                    'walls' => Gebouw::where('type', 'buitenMuur')
                                     ->orWhere('type', 'binnenMuur')
                                     ->get(),
                    'ceilings' => Gebouw::where('type', 'plafond')
                                        ->get(),
                    'floors' => Gebouw::where('type', 'vloer')
                                        ->get()
                ]);
                break;
            case "gebouw":
                return view('gebouw', [
                    'rooms' => Gebouw::where('type', 'ruimte')
                        ->get()
                ]);
                break;
        }
    }

    public function store($type){
        //Save the created resource
        if($type == "ruimte") return $this->storeRoom();
        if($type == "gebouw") return $this->storeBuilding();

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
            else $value += (($dikteArr[$i] / 1000) / $material->value);
        }

        $saveString = "";

        for($i = 0; $i < count($matArr); $i++){
            if($i == 0) $saveString .= $matArr[$i] . ":" . $dikteArr[$i];
            else $saveString .= ";" . $matArr[$i] . ":" . $dikteArr[$i];
        }

        $gebouw = new Gebouw();
        $gebouw->name = request('naam');
        $gebouw->type = request('type');
        $gebouw->value = $value;
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');

    }

    public function storeRoom(){
        request()->validate([
            'naam' => 'required',
            'gebouwen.*' => 'required',
            'height.*' => 'required',
            'width.*' => 'required',
            'tempIn' => 'required',
            'tempOut.*' => 'required'
            ]);

        $gebArr = request('gebouwen');
        $heightArr = request('height');
        $widthArr = request('width');
        $tempIn = request('tempIn');
        $tempOut = request('tempOut');

        $totalValue = 0;
        $saveString = "";

        for($i = 0; $i < count($gebArr); $i++){
            $geb = Gebouw::find($gebArr[$i]);
            $totalValue += (($tempIn - $tempOut[$i]) * ($heightArr[$i] * $widthArr[$i]) * (1 / $geb->value));
            if($i == 0) $saveString .= $gebArr[$i] . ':' . $heightArr[$i] . ':' . $widthArr[$i] . ':' . $tempIn . ':' . $tempOut[$i];
            else $saveString .= ";" . $gebArr[$i] . ':' . $heightArr[$i] . ':' . $widthArr[$i] . ':' . $tempIn . ':' . $tempOut[$i];
        }

        $gebouw = new Gebouw();
        $gebouw->name = request('naam');
        $gebouw->type = "ruimte";
        $gebouw->value = round($totalValue, 3);
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');
    }

    public function storeBuilding(){
        request()->validate([
                'ruimtes.*' => 'required',
                'naam' => 'required'
            ]);

        $ruimteArr = request('ruimtes');

        $totalValue = 0;
        $saveString = "";

        for($i = 0; $i < count($ruimteArr); $i++){
            $ruimte = Gebouw::find($ruimteArr[$i]);
            $totalValue += $ruimte->value;
            if($i == 0)$saveString .= $ruimteArr[$i];
            else $saveString .= ';' . $ruimteArr[$i];
        }

        $gebouw = new Gebouw();
        $gebouw->name = request('naam');
        $gebouw->type = "gebouw";
        $gebouw->value = round($totalValue, 3);
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');
    }

    public function edit($id){
        if(Gebouw::where('id', '=', $id)->exists()){
            $gebouw = Gebouw::find($id);
            $type = $gebouw->type;
            switch($type){
                case "muur":
                    return view('muurEdit', [
                        'materials' => Material::all(),
                        'gebouw' => $gebouw
                    ]);
                    break;
                case "plafond":
                    return view('plafondEdit', [
                        'materials' => Material::all(),
                        'gebouw' => $gebouw
                    ]);
                    break;
                case "vloer":
                    return view('vloerEdit', [
                        'materials' => Material::all(),
                        'gebouw' => $gebouw
                    ]);
                    break;
                case "ruimte":
                    return view('ruimteEdit', [
                        'walls' => Gebouw::where('type', 'buitenMuur')
                                     ->orWhere('type', 'binnenMuur')
                                     ->get(),
                        'ceilings' => Gebouw::where('type', 'plafond')
                            ->get(),
                        'floors' => Gebouw::where('type', 'vloer')
                            ->get(),
                        'gebouw' => $gebouw
                    ]);
                    break;
                case "gebouw":
                    return view('gebouwEdit', [
                        'rooms' => Gebouw::where('type', 'ruimte')
                            ->get(),
                        'gebouw' => $gebouw
                    ]);
                    break;
            }
        }
        return redirect('/calculator');
    }

    public function update($id){
        //Save the edited resource
        $gebouw = Gebouw::find($id);
        if($gebouw->type == "ruimte") return $this->updateRuimte($id);
        else if($gebouw->type == "gebouw") return $this->updateGebouw($id);

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
            if($i == 0) $saveString .= $matArr[$i] . ":" . $dikteArr[$i];
            else $saveString .= ";" . $matArr[$i] . ":" . $dikteArr[$i];
        }

        $gebouw->name = request('naam');
        $gebouw->type = request('type');
        $gebouw->value = $value;
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');
    }

    public function updateRuimte($id){
        request()->validate([
            'naam' => 'required',
            'gebouwen.*' => 'required',
            'height.*' => 'required',
            'width.*' => 'required',
            'tempIn' => 'required',
            'tempOut.*' => 'required'
            ]);

        $gebArr = request('gebouwen');
        $heightArr = request('height');
        $widthArr = request('width');
        $tempIn = request('tempIn');
        $tempOut = request('tempOut');

        $totalValue = 0;
        $saveString = "";

        for($i = 0; $i < count($gebArr); $i++){
            $geb = Gebouw::find($gebArr[$i]);
            $totalValue += (($tempIn - $tempOut[$i]) * ($heightArr[$i] * $widthArr[$i]) * (1 / $geb->value));
            if($i == 0) $saveString .= $gebArr[$i] . ':' . $heightArr[$i] . ':' . $widthArr[$i] . ':' . $tempIn . ':' . $tempOut[$i];
            else $saveString .= ";" . $gebArr[$i] . ':' . $heightArr[$i] . ':' . $widthArr[$i] . ':' . $tempIn . ':' . $tempOut[$i];
        }

        $gebouw = Gebouw::find($id);
        $gebouw->name = request('naam');
        $gebouw->type = "ruimte";
        $gebouw->value = round($totalValue, 3);
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');
    }

    public function updateGebouw($id){
        request()->validate([
            'naam' => 'required',
            'ruimtes.*' => 'required'
        ]);

        $ruimteArr = request('ruimtes');

        $totalValue = 0;
        $saveString = "";

        for($i = 0; $i< count($ruimteArr); $i++){
            $ruimte = Gebouw::find($ruimteArr[$i]);
            $totalValue += $ruimte->value;
            if($i == 0)$saveString .= $ruimteArr[$i];
            else $saveString .= ';' . $ruimteArr[$i];
        }

        $gebouw = Gebouw::find($id);
        $gebouw->name = request('naam');
        $gebouw->type = "gebouw";
        $gebouw->value = round($totalValue, 3);
        $gebouw->saveString = $saveString;

        $gebouw->save();

        return redirect('/calculator');
    }

    public function destroy(){
        //Delete the resource
    }
}
