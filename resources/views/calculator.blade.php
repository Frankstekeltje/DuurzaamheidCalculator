@extends('calculatorLayout')

@section('body')
    <div style="text-align:center">
        <br>
        <br>
        <table style="border:1px solid black;margin-left:auto;margin-right:auto;">
            <tr>
                <th>Naam</th>
                <th>Type</th>
                <th>R waarde</th>
                <th>   </th>
            </tr>
            @foreach ($gebouwen as $gebouw)
                <tr>
                    <td>{{$gebouw->name}}</td>
                    <td>{{$gebouw->type}}</td>
                    <td>{{$gebouw->value}}</td>
                    <td><button onclick="document.location = 'public/../calculator/{{$gebouw->id}}/edit'" type="button" class="btn btn-outline-success btn-sm">Edit</button></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection