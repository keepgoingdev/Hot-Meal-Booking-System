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
                <form enctype="multipart/form-data" class="form-horizontal"  action="{{ route('meals.update', $meal->id) }}" method="POST">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <div class="form-line">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ $meal->name }}" required>
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
                                       value="{{ $meal->serving_size }}" required>
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
                                       value="{{ $meal->calories }}" required>
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
                                       value="{{ $meal->store }}" required>
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
                                       value="{{ $meal->notes }}">
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
                            <input id="image" type="checkbox" @if($meal->is_snack == true) checked="checked" @endif name="is_snack">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_breakfast" class="col-md-4 control-label">Is Breakfast?</label>
                        <div class="col-md-6 text-center">
                            <input id="is_breakfast" type="checkbox" @if($meal->is_breakfast == true) checked="checked" @endif name="is_breakfast">
                            @if ($errors->has('is_breakfast'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('is_breakfast') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_lunch" class="col-md-4 control-label">Is Lunch?</label>
                        <div class="col-md-6 text-center">
                            <input id="is_lunch" type="checkbox" @if($meal->is_lunch == true) checked="checked" @endif name="is_lunch">
                            @if ($errors->has('is_lunch'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('is_lunch') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_dinner" class="col-md-4 control-label">Is Dinner?</label>
                        <div class="col-md-6 text-center">
                            <input id="is_dinner" type="checkbox" @if($meal->is_dinner == true) checked="checked" @endif name="is_dinner">
                            @if ($errors->has('is_dinner'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('is_dinner') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-md-4 control-label">Is Enabled?</label>
                        <div class="col-md-6 text-center">
                            <input id="image" type="checkbox" @if($meal->is_enabled == true) checked="checked" @endif name="is_enabled">
                            @if ($errors->has('is_enabled'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('is_enabled') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn waves-effect btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>


            </div>

        </div>

    </div>
@endsection