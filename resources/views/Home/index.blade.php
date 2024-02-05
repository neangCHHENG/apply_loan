@extends('layouts.app')

@section('content')
    <div id='containerDiv'>
        <center>
            <h1>Welcome to MJQ Job Adminstration</h1>
        </center>
        @include('../layouts/dashboard')
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@stop
