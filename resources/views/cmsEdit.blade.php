@extends('layout')

@section('body')
    <div style="text-align:center">
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <input placeholder="Naam materiaal" type="text" name="naam" value="{{$material[0]->name}}">
            <br>
            <br>
            <select name="type">
                @foreach ($types as $type)
                    @if ($type->type == $material[0]->type)
                        <option selected value="{{$type->type}}">{{$type->type}}</option>
                    @else
                        <option value="{{$type->type}}">{{$type->type}}</option>
                    @endif
                @endforeach
            </select>
            <br>
            <br>
            <input placeholder="Waarde materiaal" type="text" name="waarde" value="{{$material[0]->value}}" onkeypress="return isNumber(event)">
            <br>
            <br>
            <button type="submit" name="submitButton" class="btn btn-outline-success">Materiaal aanpassen</button>
            <br>
            <br>
        </form>
        <button type="button" name="deleteButton" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Verwijder dit materiaal</button>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Weet U het zeker?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Deze actie is permanent en kan niet ongedaan worden, weet U zeker dat U hiermee door wilt gaan?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
                        <button type="button" class="btn btn-primary" onclick="document.location = './delete'">Ja</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    function isNumber(event){
        var keycode = event.keyCode;
        if(keycode >= 48 && keycode < 57 || keycode == 46) return true;
        else return false;
    }
@endsection
