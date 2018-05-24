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
                <a class="btn btn-default" href="{{ route('meals.create') }}">Create New</a><br>
                <div class="col-sm-12">
                    <div style="float:left;">
                        {{ $meals->links() }}
                    </div>
                    <div style="float: right;">
                        <form>
                            <input class="form-control" name="s" placeholder="Search Meal Name" value="{{request()->get('s')}}">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Serving Size</th>
                    <th>Calories</th>
                    <th>Notes</th>
                    <th>Store</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($meals as $meal)
                        <tr>
                            <td><img src="{{ $meal->image }}" style="max-height:50px" class="img img-responsive" alt="">
                            </td>
                            <td>{{$meal->name}}</td>
                            <td>{{$meal->serving_size}}</td>
                            <td>{{$meal->calories}}</td>
                            <td>{{$meal->notes}}</td>
                            <td>{{$meal->store}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('meals.edit', $meal->id) }}">Edit</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $meals->links() }}
                <script>
                  $('.deleteMeal').on('click', function (e) {

                    var a = $(this);
                    var link = a.attr('href');
                    $.ajax({
                      url: link,
                      type: 'DELETE',
                      dataType: 'JSON',
                      data: '_token = {{ csrf_token() }}',
                      success: function (d) {

                      },
                      error: function (d) {

                      }
                    });
                  });
                </script>

            </div>

        </div>

    </div>
@endsection