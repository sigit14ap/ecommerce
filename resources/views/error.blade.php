@extends('layouts.app')
@section('main-content')
@section('title', Session::get('error_msg'))
<div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>Error Page</li>
                    </ul>


                    <div class="row" id="error-page">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="box">

                                <p class="text-center">
                                    <img src="img/logo.png" alt="Obaju template">
                                </p>
                                @if(Session::has('error_msg'))
                                <h2>{{ Session::get('error_msg') }}</h2>
                                @endif
                                <p class="text-center">To continue please use the <strong>Search form</strong> or <strong>Menu</strong> above.</p>

                                <p class="buttons"><a href="{{route('home')}}" class="btn btn-primary"><i class="fa fa-home"></i> Go to Homepage</a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->



@endsection