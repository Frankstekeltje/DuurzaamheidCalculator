@extends('layout')

@section('body')
    <div style="text-align:center">
        <button onclick="document.location = './cms/create'" type="button" class="button is-primary">Voeg materiaal toe</button>
        <br>
        <br>
        <table class="table is-bordered is-striped is-narrow is-hoverable">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Type</th>
                    <th>R of delta Waarde</th>
                    <th>   </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($materials as $material)
                <tr>
                    <td>{{$material->name}}</td>
                    <td>{{$material->type}}</td>
                    <td>{{$material->value}}</td>
                    <td><button onclick="document.location = './cms/{{$material->id}}/edit'" type="button" class="btn btn-outline-success btn-sm">Edit</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row level-item">
            <th>{{ $materials->links() }}</th>
        </div>
    </div>
@endsection
