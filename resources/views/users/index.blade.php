@extends('layouts.app')

@section('content')
    @include('layouts.navbar')
    <div class="container" id="container-profile ">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>User Administration</h2>
            </div>

            <div class="col-lg-12">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                        {!! $users->appends(\Request::except('page'))->render() !!}
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>@sortablelink('first_name', 'First Name')</th>
                            <th>@sortablelink('last_name', 'Last Name')</th>
                            <th>@sortablelink('email', 'Email')</th>
                            <th>Discount Code</th>
                            <th>Subscription</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->coupon_code}}</td>
                                    <td>{{$user->subscription}}</td>
                                    <td>
                                        <a class="btn btn-danger deleteUser" href="{{ route('users.destroy', $user->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $users->appends(\Request::except('page'))->render() !!}
                        <script>
                            $('.deleteUser').on('click', function (e) {

                                var a = $(this);
                                var link = a.attr('href');
                                a.attr('href', '#');
                                debugger;
                                $.ajax({
                                    url: link,
                                    type: 'DELETE',
                                    data: '_token = {{ csrf_token() }}',
                                    success: function(response) {
                                        location.reload();
                                    }
                                });
                            });
                        </script>

            </div>

        </div>

    </div>
@endsection