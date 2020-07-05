@extends('calculatorLayout')

@section('body')
    @php
        $saveArr = explode(";", $gebouw->saveString);

        $topLine = 0;
        $bottomLine = 0;
        foreach ($saveArr as $ruimte) {
            for($i = 0; $i < count($ruimtes); $i++){
                if($ruimtes[$i]->id == $ruimte){
                $ruimte = $ruimtes[$i];
                break;
                }
            }
            $saveStringRuimte = explode(";", $ruimte->saveString);
            foreach ($saveStringRuimte as $save){
                list($id, $height, $width, $tempIn, $tempOut) = explode(":", $save);
                $gebouw;
                for($i = 0; $i < count($muren); $i++){
                    if($muren[$i]->id == $id){
                        $bottomLine += ($height * $width);
                        $topLine += ($muren[$i]->value * ($height * $width));
                    }
                }
                for($i = 0; $i < count($vloeren); $i++){
                    if($vloeren[$i]->id == $id){
                        $bottomLine += ($height * $width);
                        $topLine += ($vloeren[$i]->value * ($height * $width));
                    }
                }
                for($i = 0; $i < count($plafonds); $i++){
                    if($plafonds[$i]->id == $id){
                        $bottomLine += ($height * $width);
                        $topLine += ($plafonds[$i]->value * ($height * $width));
                    }
                }
            }


        }
        $rAverage = $topLine / $bottomLine;
        $volLast = 2250 - ((200 / 1.5) * $rAverage);
        $qYear = $gebouw->value * $volLast;
        $priceYear = $qYear * 0.14;
    @endphp

    <div class="card has-background-danger has-text-white">
        <div class="card-content title has-text-white">{{ $ruimte->name }}</div>
        <div class="card-body">
            <p class="card-title is-size-3">Informatie</p>
            <table class="table is-bordered is-striped is-narrow has-background-danger has-text-white">
                <thead>
                <tr>
                    <th class="has-text-white">Naam</th>
                    <th class="has-text-white">Type</th>
                    <th class="has-text-white">R waarde</th>
                    <th class="has-text-white">Verbruik in KW/H</th>
                    <th class="has-text-white">Prijs in €</th>
                    <th class="has-text-white">Edit</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$gebouw->name}}</td>
                        <td>{{$gebouw->type}}</td>
                        <td>{{$gebouw->value}}</td>
                        <td>{{$qYear}}</td>
                        <td>{{$priceYear}}</td>
                        <td><button onclick="document.location = '../../calculator/{{$gebouw->id}}/edit'" type="button" class="button is-primary is-small">Edit</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
