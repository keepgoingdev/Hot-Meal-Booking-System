@extends('layouts.app')
@section('content')
    <script src="https://fast.wistia.com/embed/medias/nbm4bg47gb.jsonp" async></script>
    <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
    <div class="header-hotmeal">
        <a href="/"><img src="img/logo.png" alt="" class="img-responsive"></a>
    </div>
    <div class="container" id="container-profile">
        <div class="col-lg-12 hidden-xs" id="box-steps">
            <ul class="steps">
                <li class="step step--incomplete step--active">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 1</span>
                </li>
                <li class="step step--incomplete step--inactive">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 2</span>
                </li>
                <li class="step step--incomplete step--inactive">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 3</span>
                </li>
                <li class="step step--incomplete step--inactive">
                    <span class="step__icon"></span>
                    <span class="step__label">Step 4</span>
                </li>
            </ul>
        </div>
        <div class="col-lg-12" id="box-show-steps-caption">
            <h3 class="text-center">Step 1: Calculate Your Daily Calorie Goal</h3>
        </div>
        <div class="col-lg-12">
            <div class="box-form">
                <form role="form" class="form-horizontal" name="calculate" method="POST"
                      action="{{ route('calculate') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="0"> Select</option>
                                    <option value="M" {{ old("gender") === 'M' ? "selected":"" }}>Male</option>
                                    <option value="F" {{ old("gender") === 'F' ? "selected":"" }}>Female</option>
                                </select>
                            </div>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                        <strong>Gender field is required.</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}">
                            </div>
                            @if ($errors->has('age'))
                                <span class="help-block">
                                        <strong>Age field is required.</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="{{ $errors->has('weight-pounds') ? ' has-error' : '' }}">
                                <label for="weight-pounds">Weight(Pounds)</label>
                                <input type="number" class="form-control" name="weight-pounds" id="weight-pounds"
                                       value="{{ old('weight-pounds') }}">
                            </div>
                            @if ($errors->has('weight-pounds'))
                                <span class="help-block">
                                        <strong>Weight(Pounds) field is required.</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="{{ $errors->has('height-feet') ? ' has-error' : '' }}">
                                <label for="height-feet">Height(Feet)</label>
                                <input type="number" class="form-control" name="height-feet" id="height-inches"
                                       value="{{ old('height-inches') }}">
                            </div>
                            @if ($errors->has('height-feet'))
                                <span class="help-block">
                                        <strong>Height(Feet) field is required.</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="{{ $errors->has('height-inches') ? ' has-error' : '' }}">
                                <label for="height-inches">Height(inches)</label>
                                <input type="number" class="form-control" name="height-inches" id="height-inches"
                                       value="{{ old('height-inches') }}">
                            </div>
                            @if ($errors->has('height-inches'))
                                <span class="help-block">
                                        <strong>Height(inches) field is required.</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                        <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                            <div class="wistia_embed wistia_async_nbm4bg47gb videoFoam=true" style="height:100%;width:100%">&nbsp;</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default btn-block btn-lg box-form-btn-green" style="margin-top: 10px">
                        Go
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
