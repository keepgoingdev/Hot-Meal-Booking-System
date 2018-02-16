@extends('layouts.app')
@section('content')
    <div id="upload-client">
        <upload-csv></upload-csv>
    </div>
        <script src="{{ URL::asset('js/UploadClient.js')}}"></script>
@endsection
