@extends('calculatorLayout')

@section('body')
    @php
        $saveArr = explode(";", $gebouw->saveString);

        $topLine = 0;
        $bottomLine = 0;
        foreach ($saveArr as $ruimte) {
            for($i = 0; $i < count($ruimtes); $i++){
                if($ruimtes[$i]->id == $ruimte)$ruimte = $ruimtes[$i];
            }
            $saveStringRuimte = explode(";", $ruimte->saveString);
            foreach ($saveStringRuimte as $save){
                list($id, $height, $width, $tempIn, $tempOut) = explode(":", $save);
                $gebouw;
                for($i = 0; $i < count($muren); $i++){
                    if($muren[$i]->id == $id){
                        $bottomLine += ($height * $width);
                        $topLine += ($muren[$i]->value * ($height * $width));
                    }else if($plafonds[$i]->id == $id){
                        $bottomLine += ($height * $width);
                        $topLine += ($plafonds[$i]->value * ($height * $width));
                    }else if($vloeren[$i]->id == $id){
                        $bottomLine += ($height * $width);
                        $topLine += ($vloeren[$i]->value * ($height * $width));
                    }
                }
            }


        }

        $rAverage = $topLine / $bottomLine;
        $volLast = 2250 - ((200 / 1.5) * $rAverage);
        $qYear = $gebouw->value * $volLast;
        $priceYear = $qYear * 0.14;
    @endphp
@endsection
