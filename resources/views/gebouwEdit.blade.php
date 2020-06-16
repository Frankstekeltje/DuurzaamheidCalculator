@extends('calculatorLayout')

@section('body')
    @if(!empty($_GET["room"]))
        @if($_GET["room"] < 0 || is_int($_GET["room"]))
            @php $roomAmount = 1; @endphp
        @elseif($_GET["room"] > 10)
            @php $roomAmount = 10; @endphp
        @else
            @php $roomAmount = $_GET["room"]; @endphp
        @endif
    @else
        @php $roomAmount = 1 @endphp
    @endif


    <div class="container-fluid">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    @for ($i = 0; $i < $roomAmount; $i++)
                        <select class="room{{$i}}" name="ruimtes[]">
                            @foreach ($rooms as $room)
                                <option value="{{$room->id}}">{{$room->name}}</option>
                            @endforeach
                        </select>
                        <button onclick="removeSelect('room{{$i}}')" id="room{{$i}}" type="button" class="btn btn-outline-danger btn-sm room{{$i}}">X</button>
                        <br>
                        <br>
                        <br>
                    @endfor
                    <br>
                    <button onclick="addRoom()" type="button" class="btn btn-outline-primary btn-sm">+</button>
                </div>

                <div class="container-fluid">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @for ($i = 0; $i < $roomAmount; $i++)
                                    <select class="room{{$i}}" name="ruimtes[]">
                                        @foreach ($rooms as $room)
                                            <option value="{{$room->id}}">{{$room->name}}</option>
                                        @endforeach
                                    </select>
                                    <button onclick="removeSelect('room{{$i}}')" id="room{{$i}}" type="button" class="btn btn-outline-danger btn-sm room{{$i}}">X</button>
                                    <br>
                                    <br>
                                @endfor
                                <input placeholder="Naam van gebouw..." type="text" name="naam">
                                <br>
                                <input type="hidden" value="ruimte" name="type">
                                <br>
                                <button type="submit" name="submitButton" class="btn btn-outline-success">Maak gebouw aan</button>
                                <br>
                            </div>
                        </div>
                    </form>
                    <br>
                    <button onclick="addSelect()" id="addSelect" type="button" class="btn btn-outline-primary">Voeg ruimte toe</button>
                    <br>
                    <br>
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
