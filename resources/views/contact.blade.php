@extends('layout')

@section('body')
    <div class="container">
        <div class="row align-items-center mt-5">
            <div class="col-6">
                <div class="col-9 ml-auto mr-auto">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">Contact gegevens</div>
                        <div class="card-body">
                            <p class="card-title">S-Boats</p>
                            <p2 class="card-text">Steijnstraat 29</p2><br>
                            <p2 class="card-text">8917 BW Leeuwarden</p2><br>
                            <p2 class="card-text">info@s-boats.nl</p2><br>
                            <p2 class="card-text">06-53420808</p2><br>
                            <br>
                            <br>
                            <p2 class="card-text">KvK: 67255434</p2><br>
                            <p2 class="card-text">BTW: NL856898624B01</p2><br>
                            <p2 class="card-text">Bank: NL22 ABNA 0512 2862 64</p2><br>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="col-9 ml-auto mr-auto">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif
                    <form method="post" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Volledige naam: </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                            <p class="form-text text-danger">{{ $errors->first('name') }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email adress: </label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                            @error('email')
                                <p class="form-text text-danger">{{ $errors->first('email') }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bericht: </label>
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror"></textarea>
                            @error('message')
                                <p class="form-text text-danger">{{ $errors->first('message') }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary">versturen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection