@extends('layouts.app')

@section('content')
    <input type="hidden" id="token-for-ajax" value="{{csrf_token()}}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" name="search" value="{{$search}}" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col"><a href="/user-list?sortByName=true">Name</a></th>
                        <th scope="col"><a href="/user-list?sortByEmail=true">Email</th>
                        <th scope="col"><a href="/user-list?sortByPhoneNumber=true">Phone Number</th>
                        <th scope="col">Identity Card</th>
                        <th scope="col">Age</th>
                        <th scope="col">City</th>
                        <th scope="col">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <th>{{$user->name}}</th>
                            <th>{{$user->email}}</th>
                            <th>{{$user->phone_number}}</th>
                            <th>{{$user->identity_card}}</th>
                            <?php
                                $date1 = new DateTime($user->date_birth);
                                $date2 = new DateTime();
                                $diff = $date1->diff($date2);

                                $anios = (int)$diff->y;
                            ?>
                            <th>{{$anios}}</th>
                            <th>{{$user->city}}</th>
                            <th><button class="btn btn-success" type="button">Update</button></th>
                            <th><button class="btn btn-danger" type="button">Delete</button></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
