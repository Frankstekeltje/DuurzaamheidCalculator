@extends('calculatorLayout')

@section('body')
   @foreach ($gebouwen as $gebouw)
    @if($gebouw->type == 'gebouw')
            <div class="column">
                    <div class="card has-text-white" style="background-color: hsl(102, 54%, 40%)">
                        <header class="card-header">
                            <p class="card-header-title has-text-white">
                                {{$gebouw->name}}
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                Dit is een gebouw dat jij persoonlijk <strong class="">{{$gebouw->name}}</strong> hebt genoemd dit gebouw heeft een R waarde van <strong>{{ $gebouw->value}}.
                                </strong>Voor meer gegevens over dit project klik je op overzicht.
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="../../gebouwOverzicht/{{$gebouw->id}}" class="card-footer-item has-text-white">Overzicht</a>
                        </footer>
                    </div>
                </div>
    @endif
    @endforeach
@endsection
