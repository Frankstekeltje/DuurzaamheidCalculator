@extends('calculatorLayout')

@section('body')
    @if(!empty($_GET["wall"]))
        @if($_GET["wall"] < 0 || is_int($_GET["wall"]))
            @php $wallAmount = 4; @endphp
        @elseif($_GET["wall"] > 10)
            @php $wallAmount = 10; @endphp
        @else
            @php $wallAmount = $_GET["wall"]; @endphp
        @endif
    @else
        @php $wallAmount = 4 @endphp
    @endif

    @if(!empty($_GET["ceiling"]))
        @if($_GET["ceiling"] < 0 || is_int($_GET["ceiling"]))
            @php $ceilingAmount = 1; @endphp
        @elseif($_GET["ceiling"] > 10)
            @php $ceilingAmount = 10; @endphp
        @else
            @php $ceilingAmount = $_GET["ceiling"]; @endphp
        @endif
    @else
        @php $ceilingAmount = 1 @endphp
    @endif

    @if(!empty($_GET["floor"]))
        @if($_GET["floor"] < 0 || is_int($_GET["floor"]))
            @php $floorAmount = 1; @endphp
        @elseif($_GET["floor"] > 10)
            @php $floorAmount = 10; @endphp
        @else
            @php $floorAmount = $_GET["floor"]; @endphp
        @endif
    @else
        @php $floorAmount = 1 @endphp
    @endif

    <div class="container-fluid">
        <form action="./ruimte" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <input placeholder="Naam van ruimte..." type="text" name="naam">
                </div>
                <div class="col-sm-4">
                    <input placeholder="Temp van ruimte..." name="tempIn" onkeypress="return isNumber(event)">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    @for ($i = 0; $i < $wallAmount; $i++)
                        <select class="wall{{$i}}" name="gebouwen[]">
                            @foreach ($walls as $wall)
                                <option value="{{$wall->id}}">{{$wall->name}}</option>
                            @endforeach
                        </select>
                        <button onclick="removeSelect('wall{{$i}}')" id="wall{{$i}}" type="button" class="btn btn-outline-danger btn-sm wall{{$i}}">X</button>
                        <br>
                        <input placeholder="Hoogte in mm" class="wall{{$i}}" type="text" name="height[]" onkeypress="return isNumber(event)">
                        <input placeholder="Breedte in mm" class="wall{{$i}}" type="text" name="width[]" onkeypress="return isNumber(event)">
                        <br>
                        <input placeholder="Temperatuur buiten de kamer" class="wall{{$i}}" type="text" name="tempOut[]" onkeypress="return isNumber(event)">
                        <br>
                    @endfor
                    <br>
                    <button onclick="addWall()" type="button" class="btn btn-outline-primary btn-sm">+</button>
                </div>

                <div class="col-sm-4">
                    @for ($i = 0; $i < $ceilingAmount; $i++)
                        <select class="ceiling{{$i}}" name="gebouwen[]">
                            @foreach ($ceilings as $ceiling)
                                <option value="{{$ceiling->id}}">{{$ceiling->name}}</option>
                            @endforeach
                        </select>
                        <button onclick="removeSelect('ceiling{{$i}}')" id="ceiling{{$i}}" type="button" class="btn btn-outline-danger btn-sm ceiling{{$i}}">X</button>
                        <br>
                        <input placeholder="Hoogte in mm" class="ceiling{{$i}}" type="text" name="height[]" onkeypress="return isNumber(event)">
                        <input placeholder="Breedte in mm" class="ceiling{{$i}}" type="text" name="width[]" onkeypress="return isNumber(event)">
                        <br>
                        <input value="-7" class="ceiling{{$i}}" type="text" name="tempOut[]" onkeypress="return isNumber(event)">
                        <br>
                    @endfor
                    <br>
                    <button onclick="addCeiling()" type="button" class="btn btn-outline-primary btn-sm">+</button>
                </div>

                <div class="col-sm-4">
                    @for ($i = 0; $i < $floorAmount; $i++)
                        <select class="floor{{$i}}" name="gebouwen[]">
                            @foreach ($floors as $floor)
                                <option value="{{$floor->id}}">{{$floor->name}}</option>
                            @endforeach
                        </select>
                        <button onclick="removeSelect('floor{{$i}}')" id="floor{{$i}}" type="button" class="btn btn-outline-danger btn-sm floor{{$i}}">X</button>
                        <br>
                        <input placeholder="lengte in mm" class="floor{{$i}}" type="text" name="height[]" onkeypress="return isNumber(event)">
                        <input placeholder="Breedte in mm" class="floor{{$i}}" type="text" name="width[]" onkeypress="return isNumber(event)">
                        <br>
                        <input value="5" class="ceiling{{$i}}" type="text" name="tempOut[]" onkeypress="return isNumber(event)">
                        <br>
                    @endfor
                    <br>
                    <button onclick="addFloor()" type="button" class="btn btn-outline-primary btn-sm">+</button>
                </div>
            </div>
            <br>
            <br>
            <button type="submit" name="submitButton" class="btn btn-outline-success">Maak ruimte</button>
        </form>
    </div>


@endsection


@section('script')
    function addWall(){
    var params = new URLSearchParams(window.location.search);
    var url = "ruimte";

    if(params.has('wall')){
    var amount = params.get('wall');
    amount = parseInt(amount);
    if(!isNaN(amount)){
    url += "?wall=" + (amount + 1) + "&";
    }
    }else{
    url += "?wall=4&";
    }

    if(params.has('ceiling')) url += "ceiling=" + params.get('ceiling') + "&";
    else url += "ceiling=1&";

    if(params.has('floor')) url += "floor=" + params.get('floor');
    else url += "floor=1";

    window.location.href=url
    }

    function addCeiling(){
    var params = new URLSearchParams(window.location.search);
    var url = "ruimte";

    if(params.has('wall')) url += "?wall=" + params.get('wall') + "&";
    else url += "?wall=4&";

    if(params.has('ceiling')){
    var amount = params.get('ceiling');
    amount = parseInt(amount);
    if(!isNaN(amount)){
    url += "ceiling=" + (amount + 1) + "&";
    }
    }else{
    url += "ceiling=1&";
    }

    if(params.has('floor')) url += "floor=" + params.get('floor');
    else url += "floor=1"

    window.location.href=url
    }

    function addFloor(){
    var params = new URLSearchParams(window.location.search);
    var url = "ruimte";

    if(params.has('wall')) url += "?wall=" + params.get('wall') + "&";
    else url += "?wall=4&";

    if(params.has('ceiling')) url += "ceiling=" + params.get('ceiling') + "&";
    else url += "ceiling=1&";

    if(params.has('floor')){
    var amount = params.get('floor');
    amount = parseInt(amount);
    if(!isNaN(amount)){
    url += "floor=" + (amount + 1);
    }
    }else{
    url += "floor=1";
    }

    window.location.href=url
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
    if(keycode >= 48 && keycode < 57 || keycode == 45) return true;
    else return false;
    }
@endsection
