@extends('layouts.app')

@section('content')
    @extends('layouts.navbar')
    <div class="container" id="container-profile">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Account settings</h2>
            </div>
            <div class="col-lg-12">
                <div class="box-form">
                    <form class="form-horizontal" method="POST" action="{{ route('update-user-data') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="first-name">First Name</label>
                                <input id="first-name" type="text" class="form-control" name="first-name"
                                       value="{{ $user->first_name }}" required autofocus>

                                @if ($errors->has('first-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first-name') }}</strong>
                                    </span>
                                @endif                                </div>
                            <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="last-name">Last Name</label>
                                <input id="last-name" type="text" class="form-control" name="last-name"
                                       value="{{ $user->last_name }}" required autofocus>

                                @if ($errors->has('last-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="email">Old password</label>
                                <input id="password" type="password" class="form-control" name="password" value=""
                                       required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="email">New password</label>
                                <input id="password" type="password" class="form-control" name="password" value=""
                                       required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default btn-block btn-lg box-form-btn-green">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection