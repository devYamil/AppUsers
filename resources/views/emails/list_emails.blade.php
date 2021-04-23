@extends('layouts.app')

@section('content')
    <input type="hidden" id="token-for-ajax" value="{{csrf_token()}}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Message</th>
                        <th scope="col">Send</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emails as $email)
                        <tr>
                            <th scope="row">{{$email->id}}</th>
                            <th>{{$email->subject}}</th>
                            <th>{{$email->destination}}</th>
                            <th>{{$email->message}}</th>
                            <th>@if($email->status_send_email == 0) <span class="badge badge-danger">NO</span> @else <span class="badge badge-success">YES</span> @endif</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
