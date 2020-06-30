@extends('calculatorLayout')

@section('body')

        @php    $saveString = $gebouw->saveString;
                $saveArr = explode(";", $saveString);
                $saveAmount = count($saveArr);
        @endphp

    <form action="" method="POST">
        @csrf
        @method('PUT')
        @for ($i = 0; $i < $saveAmount; $i++)
            <select class="select{{$i}}" id="select{{$i}}" name="select[]">
                @php
                    $prevMaterialType = "";
                    list($id, $dikte) = explode(":", $saveArr[$i]);
                @endphp

                @foreach ($materials as $material)
                    @if ($prevMaterialType == "")
                        @php
                            $prevMaterialType = $material->type;
                        @endphp
                        <optgroup label="{{$material->type}}">
                            @if($material->type != "Luchtspouw")
                                @if($id == $material->id)<option selected value="{{$material->id}}">{{$material->name}}</option>
                                @else <option value="{{$material->id}}">{{$material->name}}</option>
                                @endif
                            @else
                                @if(strpos($material->name, 'wand') !== false)
                                    @if($id == $material->id)<option selected value="{{$material->id}}">{{$material->name}}</option>
                                    @else <option value="{{$material->id}}">{{$material->name}}</option>
                                    @endif
                                @endif
                            @endif
                    @elseif($prevMaterialType == $material->type)
                            @if($material->type != "Luchtspouw")
                                @if($id == $material->id)<option selected value="{{$material->id}}">{{$material->name}}</option>
                                @else <option value="{{$material->id}}">{{$material->name}}</option>
                                @endif
                            @else
                                @if(strpos($material->name, 'wand') !== false)
                                    @if($id == $material->id)<option selected value="{{$material->id}}">{{$material->name}}</option>
                                    @else <option value="{{$material->id}}">{{$material->name}}</option>
                                    @endif
                                @endif
                            @endif
                    @else
                        @php
                            $prevMaterialType = $material->type;
                        @endphp
                        </optgroup>
                        <optgroup label="{{$material->type}}">
                            @if($material->type != "Luchtspouw")
                                @if($id == $material->id)<option selected value="{{$material->id}}">{{$material->name}}</option>
                                @else <option value="{{$material->id}}">{{$material->name}}</option>
                                @endif
                            @else
                                @if(strpos($material->name, 'wand') !== false)
                                    @if($id == $material->id)<option selected value="{{$material->id}}">{{$material->name}}</option>
                                    @else <option value="{{$material->id}}">{{$material->name}}</option>
                                    @endif
                                @endif
                            @endif
                    @endif
                @endforeach
                        </optgroup>
            </select>
            <input placeholder="Dikte in mm" value="{{$dikte}}" class="select{{$i}}" type="text" name="dikte[]" onkeypress="return isNumber(event)">
            <br>
            <br>
        @endfor
        <input value="{{$gebouw->name}}" placeholder="Naam van muur..." type="text" name="naam">
        <br>
        <input type="hidden" value="muur" name="type">
        <br>
        <button type="submit" name="submitButton" class="btn btn-outline-success">Pas muur aan</button>
    </form>

@endsection

@section('script')
    function isNumber(event){
        var keycode = event.keyCode;
        if(keycode >= 48 && keycode < 57) return true;
        else return false;
    }
@endsection
