@extends('layouts.app')
@section('main-content')
@section('title', 'Ubah Kategori')
<div class="container">
    @if(Session::has('success_msg'))
    <div class="col-md-12">
                    <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2> <i class="fa fa-check fa-lg" aria-hidden="true"></i>&nbsp;{{ Session::get('success_msg') }}</h2>
                        </div>
                    </div>
                </div>
    </div>
    @endif

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>Ubah Kategori</li>
                    </ul>

                </div>

                <div class="col-md-12">
                    <div class="box">
                        <h1>Ubah Kategori</h1>
                        <hr>

                        <form role="form" action="{{ route('update.kat',$kategori->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                             <div class="form-group">
                                        <label for="judul">Nama Kategori</label>
                                        <input type="text" class="form-control" id="name_kat" name="nama_kat" value="{{$kategori->nama_kat}}" placeholder="Nama Kategori. . ." required>
                                        @if ($errors->has('nama_kat'))
                                        <div class="alert alert-danger">
                                        <strong>Error!</strong> Nama Kategori diperlukan , isi dengan benar.
                                        </div>
                                        @endif
                              </div>
                              <div class="form-group">
                                        <label for="judul">Bagian</label>
                                        <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" name="bagian">
                                        <option data-subtext="Man" value="Pria"
                                        @if($kategori->bagian == "Pria")
                                        selected
                                        @endif
                                        >Pria</option>
                                        <option data-subtext="Woman" value="Wanita"
                                        @if($kategori->bagian == "Wanita")
                                        selected
                                        @endif
                                        >Wanita</option>
                                        </select>
                                        @if ($errors->has('id_kategori'))
                                        <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $errors->first('id_kategori') }}.
                                        </div>
                                        @endif
                              </div>
                            <div class="container">
                            <div class="form-group col-md-4 col-xs-6">
                                <label for="foto">Foto</label>
                                <div  style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);">
                                    <img id="uploadPreview" src="{{asset('img/categories/'.$kategori->foto)}}" class="img-responsive" style="width: 350px;height: 171px;">
                                <input type="file" name="foto" id="uploadImage" class="file" onchange="PreviewImage();" style="display: none;">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" style="width: 101%;" type="button"><i class="fa fa-search" aria-hidden="true"></i> Ubah Foto</button>
                                </span>
                                </div>
                                @if ($errors->has('foto'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto') }}.
                                </div>
                                @endif
                            </div>
                          </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        



<script type="text/javascript">
  $(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

$(document).ready(function(){
        $('#example').DataTable();
    });

function formatangka(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}
function PreviewImage() {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
  oFReader.onload = function (oFREvent)
   {
      document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
  };
</script>






  @endsection