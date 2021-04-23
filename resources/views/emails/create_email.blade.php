@extends('layouts.app')

@section('content')
    @if($alert == 'true')
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Message!</h4>
            <p>The Email has been successfull created!!</p>
        </div>
    @endif
    <input type="hidden" id="token-for-ajax" value="{{csrf_token()}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Form Emails') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/register-emails">
                            @csrf

                            <div class="form-group row">
                                <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                                <div class="col-md-6">
                                    <input id="subject" type="text" class="form-control" name="subject" required autocomplete="subject" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="destination" class="col-md-4 col-form-label text-md-right">{{ __('Destination') }}</label>

                                <div class="col-md-6">
                                    <input id="destination" type="text" class="form-control" name="destination" required autocomplete="destination">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                                <div class="col-md-6">
                                    <input id="message" type="text" class="form-control" name="message" required autocomplete="message">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Data Email
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

@endsection
