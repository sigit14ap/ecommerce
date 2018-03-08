@extends('layouts.app')
@section('main-content')
@section('title', 'Pesanan')
<div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>Kelola Pesanan</li>
                    </ul>

                </div>

                <div class="col-md-12">
                    <div class="box">
                        <div class="panel panel-default">
                                  <div class="panel-heading">
                                    ASASDASD
                                </div>
                                  <div class="panel-body">
                                  <div class="media">
                                    <div class="media-left media-top">
                                        <a href="asd">
                                                <img src="asd" class="media-object" style="width:80px">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading" style="float: left;height: 15px">
                                      <a href="asd">
                                        asd
                                      </a>
                                      </h4>
                                      <h4 class="media-heading" style="float: right;">
                                        <p id="total">Rp{{-- {{number_format($cart2->total,0,",",".")}} --}}</p>
                                      </h4><br>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                    </div>
                </div>

            </div>
        

  @endsection