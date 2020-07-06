@extends('layout')

@section('body')
        <div class="columns is-centered">
            <div class="column is-two-fifths">
                <div class="card has-text-white" style="background-color: hsl(102, 54%, 40%)">
                    <div class="card-content title has-text-white">Contact gegevens</div>
                    <div class="card-body">
                        <p class="card-title is-size-3">S-Boats</p>
                        <p2 class="card-text is-size-5	">Steijnstraat 29</p2><br>
                        <p2 class="card-text is-size-5	">8917 BW Leeuwarden</p2><br>
                        <p2 class="card-text is-size-5	">info@s-boats.nl</p2><br>
                        <p2 class="card-text is-size-5	">06-53420808</p2><br>
                        <br>
                        <br>
                        <p2 class="card-text is-size-5">KvK: 67255434</p2><br>
                        <p2 class="card-text is-size-5	">BTW: NL856898624B01</p2><br>
                        <p2 class="card-text is-size-5	">Bank: NL22 ABNA 0512 2862 64</p2><br>
                    </div>
                </div>
            </div>
            <div class="column is-two-fifths">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                @endif
                <form method="post" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Volledige naam: </label>
                        <input type="text" class="input is-primary @error('name') is-invalid @enderror" name="name">
                        @error('name')
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Email adress: </label>
                        <input type="text" class="input is-primary @error('email') is-invalid @enderror" name="email">
                        @error('email')
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Bericht: </label>
                        <textarea name="message" class="textarea is-large is-primary @error('message') is-invalid @enderror"></textarea>
                        @error('message')
                            <p class="help is-danger">{{ $errors->first('message') }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <button class="button is-primary is-medium">versturen</button>
                    </div>
                </form>
            </div>
        </div>
@endsection