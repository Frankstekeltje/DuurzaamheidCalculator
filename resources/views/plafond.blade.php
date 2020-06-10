@extends('calculatorLayout')

@section('head')
    <link href="{{ asset('css/selectize.default.css') }}" rel="stylesheet">
@endsection

@section('body')
    @if(!empty($_GET["amount"]))
        @if($_GET["amount"] < 0 || is_int($_GET["amount"]))
            @php $selectAmount = 2; @endphp
        @elseif($_GET["amount"] > 10)
            @php $selectAmount = 10; @endphp
        @else
            @php $selectAmount = $_GET["amount"]; @endphp
        @endif
    @else
        @php $selectAmount = 2 @endphp
    @endif

    <form action="" method="POST">
        @csrf
        @for ($i = 0; $i < $selectAmount; $i++)
            <select class="select{{$i}}" id="select{{$i}}" name="select[]">
                @php
                    $prevMaterialType = "";
                @endphp

                @foreach ($materials as $material)
                    @if ($prevMaterialType == "")
                        @php
                            $prevMaterialType = $material->type;
                        @endphp
                        <optgroup label="{{$material->type}}">
                            <option value="{{$material->id}}">{{$material->name}}</option>
                    @elseif($prevMaterialType == $material->type)
                            <option value="{{$material->id}}">{{$material->name}}</option>
                    @else
                        @php
                            $prevMaterialType = $material->type;
                        @endphp
                        </optgroup>
                        <optgroup label="{{$material->type}}">
                            <option value="{{$material->id}}">{{$material->name}}</option>
                    @endif
                @endforeach
                        </optgroup>
            </select>
            <input class="select{{$i}}" type="text" name="dikte[]" onkeypress="return isNumber(event)">
            <button onclick="removeSelect('select{{$i}}')" id="select{{$i}}" type="button" class="btn btn-outline-danger btn-sm select{{$i}}">X</button>
            <br>
            <br>
        @endfor
        <label>Naam van plafond:</label><input type="text" name="naam">
        <input type="hidden" value="plafond" name="type">
        <br>
        <button type="submit" name="submitButton" class="btn btn-outline-success">Maak plafond aan</button>
    </form>
    <br>
    <button onclick="addSelect()" id="addSelect" type="button" class="btn btn-outline-primary">Voeg materiaal toe</button>
    <br>
    <br>

@endsection

@section('script')
    function addSelect(){
        var params = new URLSearchParams(window.location.search);
        if(params.has('amount')){
            var amount = params.get('amount');
            amount = parseInt(amount);
            if(!isNaN(amount)){
                window.location.href="plafond?amount=" + (amount + 1);
            }
        }else{
            window.location.href="plafond?amount=3";
        }
    }

    function removeSelect(elementid){
        var elements = document.getElementsByClassName(elementid);
        var length = elements.length;
        for(var i = 0; i < length; i++){
            elements[0].parentNode.removeChild(elements[0]);
        }
    }

    function isNumber(event){
        var keycode = event.keyCode;
        if(keycode >= 48 && keycode < 57) return true;
        else return false;
    }
@endsection
