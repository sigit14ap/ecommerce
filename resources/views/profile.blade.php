@extends('layouts.app')
@section('main-content')
@section('title', 'Informasi Akun')

<style type="text/css">
.loader {
  border: 3px solid #f3f3f3;
  border-radius: 50%;
  border-top: 3px solid blue;
  border-bottom: 3px solid blue;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.table {
    border-bottom:0px !important;
}
.table th, .table td {
    border: 1px !important;
}
.table-bordered {
    border:0px !important;
}
tr.border_bottom td {
  border-bottom:1pt solid black;
}
tr.border_bottom td {
	border-bottom: 1px solid #ccc!important;
}

</style>
<div class="container">
	
                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>Informasi Akun</li>
                    </ul>

                </div>


   <div class="col-md-12">
	<div class="box">
		 <div class="row">
		    <div class="col-md-12"><h3>Informasi Akun</h3>

		      <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-map-marker"></i><br>Alamat</a></li>
                                <li><a href="#tab2" data-toggle="tab"><i class="fa fa-truck"></i><br>Informasi Pribadi</a></li>
                                <li><a href="#tab3" data-toggle="tab"><i class="fa fa-money"></i><br>Metode Pembayaran</a></li>
                                <li><a href="#tab4" data-toggle="tab"><i class="fa fa-eye"></i><br>Order Review</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                	<br>
                                	<div id="alert" style="display: none;">

                                	</div>
                                        @include('address')
                                      </div>
                                <div class="tab-pane" id="tab2">
                                	<br>
                                    <a class="btn btn-primary btnNext" >Next</a>
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                </div>
                            </div>
		  </div>
	</div>
</div>

</div>
</div>
            <!-- /.container -->

@endsection