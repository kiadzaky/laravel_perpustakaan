@extends('admin.master')
@section('header')

<div class="header"> 
                        <h1 class="page-header">
                            Siswa <small>Summary of your App</small>
                        </h1>
						
									
		    </div>
@endsection
@section('konten')
<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Advanced Tables
                        </div>
                        <br>
                        <div class="">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Siswa</button>
                        </div>
                        <div class="panel-body">
                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTableSiswa">
                                    <thead>
                                        <tr>
                                            <!-- <th>No</th> -->
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambah Siswa</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('siswa.store')}}" method="POST">
                                            @csrf
                                                <div class="form-group">
                                                    <label>NIS</label>
                                                    <input class="form-control" placeholder="Enter text" name="nis" value="{{old('nis')}} ">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control" placeholder="Enter text" name="nama" value ="{{old('nama')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea name="alamat" id="alamat" cols="" rows="" class="form-control" placeholder="Enter text">{{old('alamat')}} </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>No Telepon</label>
                                                    <input class="form-control" placeholder="Enter text" name="no_telepon" value="{{old('no_telepon')}}" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save changes"></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambah Siswa</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="form_edit">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label>NIS</label>
                                                    <input class="form-control" placeholder="Enter text" name="nis" id ="nis_edit" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control" placeholder="Enter text" name="nama" id="nama_edit">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea name="alamat" id="alamat_edit" cols="" rows="" class="form-control" placeholder="Enter text"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>No Telepon</label>
                                                    <input class="form-control" placeholder="Enter text" name="no_telepon" id = "no_telepon_edit" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                                </div>
                                                
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-success" value="Edit changes"></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<script>
    function fungsiEdit(nis, nama, alamat, no_telepon){
        $('#form_edit').attr('action', "{{route('siswa.update', '')}}"+"/"+nis);
        var id_siswa = $('#edit').attr('data-id');
        var nis = $('#edit').attr('data-nis');
        var nama = $('#edit').attr('data-nama');
        var alamat = $('#edit').attr('data-alamat');
        var no_telepon = $('#edit').attr('data-no_telepon');
        $('#nis_edit').val(nis);
        $('#nama_edit').val(nama);
        $('#alamat_edit').text(alamat);
        $('#no_telepon_edit').val(no_telepon);
    }
</script>

@endsection