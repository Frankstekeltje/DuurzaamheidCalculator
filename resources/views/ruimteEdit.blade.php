@extends('calculatorLayout')

@section('body')
    @php
        $wallArr = [];
        $floorArr = [];
        $ceilingArr = [];
        $saveArr = explode(";", $gebouw->saveString);
        foreach($saveArr as $save){
            list($id, $height, $width, $tempIn, $tempOut) = explode(":", $save);
            $gebouw = App\Gebouw::find($id);
            switch($gebouw->type){
                case "muur":
                    array_push($wallArr, $save);
                    break;
                case "plafond":
                    array_push($ceilingArr, $save);
                    break;
                case "vloer":
                    array_push($floorArr, $save);
                    break;
            }
        }

        $wallAmount = count($wallArr);
        $ceilingAmount = count($ceilingArr);
        $floorAmount = count($floorArr);
    @endphp

    <div class="container-fluid">
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-4">
                    @for ($i = 0; $i < $wallAmount; $i++)
                        @php
                            list($id, $height, $width, $tempIn, $tempOut) = explode(":", $wallArr[$i]);
                        @endphp
                        <select class="wall{{$i}}" name="gebouwen[]">
                            @foreach ($walls as $wall)
                                @if($id == $wall->id)<option selected value="{{$wall->id}}">{{$wall->name}}</option>
                                @else <option value="{{$wall->id}}">{{$wall->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <input value="{{$height}}" placeholder="Hoogte in mm" class="wall{{$i}}" type="text" name="height[]" onkeypress="return isNumber(event)">
                        <input value="{{$width}}" placeholder="Breedte in mm" class="wall{{$i}}" type="text" name="width[]" onkeypress="return isNumber(event)">
                        <br>
                        <input value="{{$tempIn}}" placeholder="Temperatuur in de kamer" class="wall{{$i}}" type="text" name="tempIn[]" onkeypress="return isNumber(event)">
                        <input value="{{$tempOut}}" placeholder="Temperatuur buiten de kamer" class="wall{{$i}}" type="text" name="tempOut[]" onkeypress="return isNumber(event)">
                        <br>
                    @endfor
                </div>

                <div class="col-sm-4">
                    @for ($i = 0; $i < $ceilingAmount; $i++)
                        @php
                            list($id, $height, $width, $tempIn, $tempOut) = explode(":", $ceilingArr[$i]);
                        @endphp
                        <select class="ceiling{{$i}}" name="gebouwen[]">
                            @foreach ($ceilings as $ceiling)
                                @if($id == $ceiling->id) <option selected value="{{$ceiling->id}}">{{$ceiling->name}}</option>
                                @else <option value="{{$ceiling->id}}">{{$ceiling->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <input value="{{$height}}" placeholder="Hoogte in mm" class="ceiling{{$i}}" type="text" name="height[]" onkeypress="return isNumber(event)">
                        <input value="{{$width}}" placeholder="Breedte in mm" class="ceiling{{$i}}" type="text" name="width[]" onkeypress="return isNumber(event)">
                        <br>
                        <input value="{{$tempIn}}" placeholder="Temp in de kamer" class="ceiling{{$i}}" type="text" name="tempIn[]" onkeypress="return isNumber(event)">
                        <input value="{{$tempOut}}" class="ceiling{{$i}}" type="text" name="tempOut[]" onkeypress="return isNumber(event)">
                        <br>
                    @endfor
                </div>

                <div class="col-sm-4">
                    @for ($i = 0; $i < $floorAmount; $i++)
                        @php
                            list($id, $height, $width, $tempIn, $tempOut) = explode(":", $floorArr[$i]);
                        @endphp
                        <select class="floor{{$i}}" name="gebouwen[]">
                            @foreach ($floors as $floor)
                                @if($id == $floor->id) <option selected value="{{$floor->id}}">{{$floor->name}}</option>
                                @else <option value="{{$floor->id}}">{{$floor->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <input value="{{$height}}" placeholder="lengte in mm" class="floor{{$i}}" type="text" name="height[]" onkeypress="return isNumber(event)">
                        <input value="{{$width}}" placeholder="Breedte in mm" class="floor{{$i}}" type="text" name="width[]" onkeypress="return isNumber(event)">
                        <br>
                        <input value="{{$tempIn}}" placeholder="Temp in de kamer" class="floor{{$i}}" type="text" name="tempIn[]" onkeypress="return isNumber(event)">
                        <input value="{{$tempOut}}" class="ceiling{{$i}}" type="text" name="tempOut[]" onkeypress="return isNumber(event)">
                        <br>
                    @endfor
                </div>
            </div>
            <br>
            <br>
            <input value="{{$gebouw->name}}" placeholder="Naam van ruimte..." type="text" name="naam">
            <br>
            <br>
            <button type="submit" name="submitButton" class="btn btn-outline-success">Maak ruimte</button>
        </form>
    </div>


@endsection


@section('script')
    function isNumber(event){
        var keycode = event.keyCode;
        if(keycode >= 48 && keycode < 57 || keycode == 45) return true;
        else return false;
    }
@endsection
