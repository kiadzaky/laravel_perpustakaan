@extends('admin.master')
@section('header')

<div class="header"> 
                        <h1 class="page-header">
                            {{$judul}} <small>Summary of your App</small>
                        </h1>
						
									
		    </div>
@endsection
@section('konten')
<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel {{$judul}} 
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
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah {{$judul}}</button>
                        </div>
                        <div class="panel-body">
                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTableBuku">
                                    <thead>
                                        <tr>
                                            <!-- <th>No</th> -->
                                            <th>Judul Buku</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            
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
                                            <form action="{{route('buku.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_buku" value="{{$uuid}}">
                                                <div class="form-group">
                                                    <label>Judul Buku</label>
                                                    <input class="form-control" placeholder="Enter text" name="judul_buku" value="{{old('judul_buku')}} ">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Penerbit</label>
                                                    <input class="form-control" placeholder="Enter text" name="penerbit" value ="{{old('penerbit')}}">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Tahun</label>
                                                    <input class="form-control" placeholder="Enter text" name="tahun_terbit" value="{{old('tahun_terbit')}}" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
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
                                            <h4 class="modal-title" id="myModalLabel">Tambah {{$judul}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="form_edit">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <label>Judul Buku</label>
                                                    <input class="form-control" placeholder="Enter text" name="judul_buku" id ="judul_buku_edit" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Penerbit</label>
                                                    <input class="form-control" placeholder="Enter text" name="penerbit" id="penerbit_edit">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tahun Terbit</label>
                                                    <input class="form-control" placeholder="Enter text" name="tahun_terbit" id = "tahun_terbit_edit" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
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
    function fungsiEdit(){
        
        var id_buku = $('#edit').attr('data-id');
        var judul_buku = $('#edit').attr('data-judul_buku');
        var penerbit = $('#edit').attr('data-penerbit');
        var tahun_terbit = $('#edit').attr('data-tahun_terbit');
        $('#form_edit').attr('action', "{{route('buku.update', '')}}"+"/"+id_buku);
        $('#judul_buku_edit').val(judul_buku);
        $('#penerbit_edit').val(penerbit);
        $('#tahun_terbit_edit').val(tahun_terbit);
    }
</script>
<script>
    $(document).ready(function () {
       
    });
</script>
<script>
        $(document).ready(function() {
            $('#dataTableBuku').DataTable( {
                processing: true,
                pageLength: 25,
                serverSide: true,
                searchable: true,
                ajax: {
                    url: "{{route('buku.json')}}"
                },
                columns: [
                    
                    {
                        data: 'judul_buku',
                        name: 'judul_buku'
                    },
                    {
                        data: 'penerbit',
                        name: 'penerbit'
                    },
                    {
                        data: 'tahun_terbit',
                        name: 'tahun_terbit'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
            } );
             $('#btn_hapus').attr('onclick', "return confirm('Yakin Hapus?')");
        } );
</script>
@endsection