@extends('layout')

@section('body')
<div style="text-align:center">
    <button onclick="document.location = './cms/create'" type="button" class="btn btn-primary">Voeg materiaal toe</button>
    <br>
    <br>
    <table style="border:1px solid black;margin-left:auto;margin-right:auto;">
        <tr>
            <th>Naam</th>
            <th>Type</th>
            <th>R of delta Waarde</th>
            <th>   </th>
        </tr>
        @foreach ($materials as $material)
            <tr>
                <td>{{$material->name}}</td>
                <td>{{$material->type}}</td>
                <td>{{$material->value}}</td>
                <td><button onclick="document.location = './cms/{{$material->id}}/edit'" type="button" class="btn btn-outline-success btn-sm">Edit</button></td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
