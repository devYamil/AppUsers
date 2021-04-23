@extends('layouts.app')

@section('content')
    @if($showMessage == true)
    <div class="alert alert-{{$typeError}}" role="alert">
        <h4 class="alert-heading">Message!</h4>
        @foreach($message as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
    @endif
    <input type="hidden" id="token-for-ajax" value="{{csrf_token()}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/user-update">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" readonly value="{{$user->email}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
                                    <input type="hidden" type="text" value="{{$user->id}}" id="id_user" name="id_user">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" value="{{$user->phone_number}}" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" required autocomplete="name">

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="identity_card" class="col-md-4 col-form-label text-md-right">{{ __('Identity Card') }}</label>

                                <div class="col-md-6">
                                    <input id="identity_card" readonly value="{{$user->identity_card}}" type="text" class="form-control @error('identity_card') is-invalid @enderror" name="identity_card">

                                    @error('identity_card')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_birth" value="{{date_format(new DateTime($user->date_birth),"Y-m-d")}}" type="date" class="form-control @error('date_birth') is-invalid @enderror" name="date_birth">

                                    @error('date_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country : ') }}</label>

                                <div class="col-md-6">
                                    <select class="selectpicker" name="country" id="country">
                                        <option value="{{$country->id}}">{{$country->name_country}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State : ') }}</label>

                                <div class="col-md-6">
                                    <select class="selectpicker" name="state" id="state">
                                        <option value="{{$state->id}}">{{$state->name_state}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City : ') }}</label>

                                <div class="col-md-6">
                                    <select class="selectpicker" name="city" id="city">
                                        <option value="{{$city->id}}">{{$city->name_city}}</option>
                                    </select>

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit User') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            var token = $('#token-for-ajax').val();

            var parametros = {
                _token : token,
            }

            $.ajax({
                data:  parametros,
                url:   '/get-countries-data',
                type:  'GET',
                dataType: "json",
                success: function(result) {
                    $.each(result.countries, function(index, value) {
                        $("#country").append('<option value="'+value.id+'">'+value.name_country+'</option>');
                    });
                },
                error: function(xhr) { // if error occured
                    console.log("Error occured.please try again", xhr);
                },
                complete: function (result) {
                    console.log("complete");
                }
            });

            $('#country').on('change', function() {

                $("#state").html('');

                $("#state").append('<option value="">-Select a State-</option>');

                var parametrosState = {
                    _token : token,
                    id_country : this.value,
                }

                $.ajax({
                    data:  parametrosState,
                    url:   '/get-states-data',
                    type:  'GET',
                    dataType: "json",
                    success: function(result) {
                        $.each(result.states, function(index, value) {
                            $("#state").append('<option value="'+value.id+'">'+value.name_state+'</option>');
                        });
                    },
                    error: function(xhr) { // if error occured
                        console.log("Error occured.please try again", xhr);
                    },
                    complete: function (result) {
                        console.log("complete");
                    }
                });
            });
            $('#state').on('change', function() {
                $("#city").html('');

                $("#city").append('<option value="">-Select a State-</option>');

                var parametrosCities = {
                    _token : token,
                    id_state : this.value,
                }

                $.ajax({
                    data:  parametrosCities,
                    url:   '/get-cities-data',
                    type:  'GET',
                    dataType: "json",
                    success: function(result) {
                        $.each(result.cities, function(index, value) {
                            $("#city").append('<option value="'+value.id+'">'+value.name_city+'</option>');
                        });
                    },
                    error: function(xhr) { // if error occured
                        console.log("Error occured.please try again", xhr);
                    },
                    complete: function (result) {
                        console.log("complete");
                    }
                });
            });
        });
    </script>
@endsection
