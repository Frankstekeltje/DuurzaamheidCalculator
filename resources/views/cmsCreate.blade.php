@extends('layout')

@section('body')
    <div style="text-align:center">
        <form action="" method="POST">
            @csrf
            <input placeholder="Naam materiaal" type="text" name="naam">
            <br>
            <br>
            <select name="type">
                @foreach ($types as $type)
                    <option value="{{$type->type}}">{{$type->type}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <input placeholder="Waarde materiaal" type="text" name="waarde" onkeypress="return isNumber(event)">
            <br>
            <br>
            <button type="submit" name="submitButton" class="btn btn-outline-success">Maak materiaal aan</button>
        </form>
    </div>
@endsection

@section('script')
    function isNumber(event){
        var keycode = event.keyCode;
        if(keycode >= 48 && keycode < 57 || keycode == 46) return true;
        else return false;
    }
@endsection
