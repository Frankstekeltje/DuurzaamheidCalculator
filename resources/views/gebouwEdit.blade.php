@extends('calculatorLayout')

@section('body')

    @php        $saveString = $gebouw->saveString;
                $saveArr = explode(";", $saveString);
                $roomAmount = count($saveArr);
    @endphp

    <div class="container-fluid">
        <form action="" method="POST">
            @csrf
            @method('PUT')
                @for ($i = 0; $i < $roomAmount; $i++)
                    <select class="room{{$i}}" name="ruimtes[]">
                        <div class="row">
                        @foreach ($rooms as $room)
                            <option value="{{$room->id}}">{{$room->name}}</option>
                        @endforeach
                        </div>
                    </select>
                    <br>
                    <br>
                @endfor
                    <br>
                    <input value="{{$gebouw->name}}" placeholder="Naam van gebouw..." type="text" name="naam">
                    <br>
                    <input type="hidden" value="ruimte" name="type">
                    <br>
                    <button type="submit" name="submitButton" class="btn btn-outline-success">Pas gebouw aan</button>
                    <br>
        </form>
    </div>
@endsection

@section('script')
    function addRoom(){
    var params = new URLSearchParams(window.location.search);
    var url = "gebouw";

    if(params.has('room')){
    var room = params.get('room');
    room = parseInt(amount);
    if(!isNaN(room)){
    url += "?room=" + (room + 1) + "&";
    }
    }else{
    url += "?room=4&";
    }

    function removeSelect(elementid){
    var elements = document.getElementsByClassName(elementid);
    var length = elements.length;
    for(var i = 0; i < length; i++){
    elements[0].parentNode.removeChild(elements[0]);
    }
    }
@endsection
