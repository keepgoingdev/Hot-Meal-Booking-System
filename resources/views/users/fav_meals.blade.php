@extends('layouts.app')

@section('content')
    @include('layouts.navbar')
    <div class="container" id="container-profile ">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Favorite Meals for {{ $user->first_name }} {{ $user->last_name }}</h2>
            </div>

            <div class="col-lg-12">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <a href="{{ route('users.index') }}" class="btn btn-success">Back to All Users</a><br><br>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Serving Size</th>
                            <th>Calories</th>
                        </thead>
                        <tbody>
                            @foreach($favoriteMeals as $meal)
                                <tr>
                                    <td><img src="{{ $meal->image }}" style="max-height:50px" class="img img-responsive" alt=""></td>
                                    <td>{{$meal->name}}</td>
                                    <td>{{$meal->serving_size}}</td>
                                    <td>{{$meal->calories}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


            </div>

        </div>

    </div>
@endsection