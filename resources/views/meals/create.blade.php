@extends('layouts.app')

@section('content')
    @include('layouts.navbar')
    <div class="container" id="container-profile ">
        <div class="col-lg-12 col-xs-12 col-sm-12" id="box-user-profile">
            <div class="col-lg-6 col-xs-12 col-sm-6">
                <h2>Meal Administration</h2>
            </div>

            <div class="col-lg-12">
                @if(session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                    <form enctype="multipart/form-data" class="form-horizontal"  action="{{ route('meals.store') }}" method="POST">
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('serving_size') ? ' has-error' : '' }}">
                            <label for="serving_size" class="col-md-4 control-label">Serving Size</label>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input id="name" type="text" class="form-control" name="serving_size"
                                           value="{{ old('serving_size') }}" required>
                                </div>
                                @if ($errors->has('serving_size'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('serving_size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('calories') ? ' has-error' : '' }}">
                            <label for="calories" class="col-md-4 control-label">Calories</label>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input id="calories" type="text" class="form-control" name="calories"
                                           value="{{ old('calories') }}" required>
                                </div>
                                @if ($errors->has('calories'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('calories') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('store') ? ' has-error' : '' }}">
                            <label for="store" class="col-md-4 control-label">Store</label>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input id="store" type="text" class="form-control" name="store"
                                           value="{{ old('store') }}" required>
                                </div>
                                @if ($errors->has('store'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('store') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                            <label for="notes" class="col-md-4 control-label">Notes</label>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input id="notes" type="text" class="form-control" name="notes"
                                           value="{{ old('notes') }}" required>
                                </div>
                                @if ($errors->has('notes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Image</label>
                            <div class="col-md-6 text-center">
                                <input id="image" class="file-upload" type="file" name="image">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Is Snack?</label>
                            <div class="col-md-6 text-center">
                                <input id="image" type="checkbox" name="is_snack">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn waves-effect btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>


            </div>

        </div>

    </div>
@endsection