@extends('layouts.app')
@section('main-content')
@section('title', 'Kelola Kategori')

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
                              <li>Kelola Kategori</li>
                          </ul>

                        </div>
                          <div class="col-md-12">
                              <div class="box">
                                        <h1>Tambah Kategori</h1>
                                        <hr>
                                  <form role="form" action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                      <div class="form-group">
                                        <label for="judul">Nama Kategori</label>
                                        <input type="text" class="form-control" id="name_kat" name="nama_kat" placeholder="Nama Kategori. . ." required>
                                        @if ($errors->has('nama_kat'))
                                        <div class="alert alert-danger">
                                        <strong>Error!</strong> Nama Kategori diperlukan , isi dengan benar.
                                        </div>
                                        @endif
                                      </div>
                                      <div class="form-group">
                                        <label for="judul">Bagian</label>
                                        <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" name="bagian">
                                        <option data-subtext="Man" value="Pria">Pria</option>
                                        <option data-subtext="Woman" value="Wanita">Wanita</option>
                                        </select>
                                        @if ($errors->has('id_kategori'))
                                        <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $errors->first('id_kategori') }}.
                                        </div>
                                        @endif
                                      </div>

                                      <div class="form-group">
                                        <label for="judul">Foto</label>
                                        <input type="file" name="foto" class="file" style="display: none;">
                                        <div class="input-group col-xs-12">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                        <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
                                        <span class="input-group-btn">
                                        <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                        </span>
                                        </div>
                                        @if ($errors->has('foto'))
                                        <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $errors->first('foto') }}.
                                        </div>
                                        @endif
                                      </div>
                                  <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
    



              <div class="col-md-12">
                    <div class="box">
                        <h1>Daftar Kategori</h1>
                        <hr>
                         <div class="table-responsive">
                            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Bagian</th>
                                        <th>Foto</th>
                                        <th>Dibuat</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Bagian</th>
                                        <th>Foto</th>
                                        <th>Dibuat</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                 @foreach($kategori as $cat)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $cat->nama_kat }}</td>
                                        <td>{{ $cat->bagian }}</td>
                                        <td><a href="{{asset('img/categories/'.$cat->foto)}}"> Open</a></td>
                                        <td>{{ $cat->created_at }}</td>
                                        <td><a href="{{ route('edit',$cat->id) }}"><button class="btn btn-primary btn-block btn-md"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></button></a></td>
                                <td>
                                 <form id="delete-form-{{ $cat->id }}" method="post" action="{{ route('destroycat',$cat->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                </form>
                                 <button class="btn btn-danger btn-block btn-md" data-toggle="modal" data-target="#myModal{!! $cat->id!!}"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button>
                                  <!-- Modal -->
                                    <div class="modal fade" id="myModal{!! $cat->id!!}" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Anda yakin ingin menghapus <strong>{{ $cat->nama_kat }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $cat->id }}').submit();"><button type="submit" class="btn btn-danger">Hapus</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->

                                </td>
                                    </tr>
                                    
                                    
                                    @endforeach
                                </tbody>
                            </table>  
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
</script>
</div>
  @endsection