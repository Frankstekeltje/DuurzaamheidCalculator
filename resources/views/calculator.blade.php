@extends('calculatorLayout')

@section('body')
        <table class="table is-bordered is-striped is-narrow is-hoverable">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Type</th>
                    <th>R waarde</th>
                    <th>   </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($gebouwen as $gebouw)
                    <tr>
                        <td>{{$gebouw->name}}</td>
                        <td>{{$gebouw->type}}</td>
                        <td>{{$gebouw->value}}</td>
                        <td><button onclick="document.location = '../../calculator/{{$gebouw->id}}/edit'" type="button" class="btn btn-outline-success btn-sm">Edit</button></td>
                    </tr>
            @endforeach
                </tbody>
        </table>
        <div class="row level-item">
            <th>{{ $gebouwen->links() }}</th>
        </div>
@endsection