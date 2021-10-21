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
            <div class="modal fade" id="modalTambah">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambah {{$judul}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('buku.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_peminjaman" value="{{$uuid}}">
                                            <style>
                                            .select2-dropdown.increasezindex {
    z-index:99999;
}
.select2-dropdown {
    z-index:99999;
}
</style>
                                                <div class="form-group">
                                                    <label>Judul Buku</label>
                                                    <select name="judul_buku" class = "form-control" id="select-buku"></select>
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
    $(document).on('click','#edit', function (event) {
        event.preventDefault();
        $('#modalEdit').modal('show');
        var id_buku = $(this).attr('data-id');
        var judul_buku = $(this).attr('data-judul_buku');
        var penerbit = $(this).attr('data-penerbit');
        var tahun_terbit = $(this).attr('data-tahun_terbit');
        $('#form_edit').attr('action', "{{route('buku.update', '')}}"+"/"+id_buku);
        $('#judul_buku_edit').val(judul_buku);
        $('#penerbit_edit').val(penerbit);
        $('#tahun_terbit_edit').val(tahun_terbit);
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
<script>
$(document).ready(function () {
    $('#select-buku').select2({
    width: 400,
  ajax: {
    url: '{{route("pinjam.buku.json")}}',
    dataType: 'json',
    type: 'GET',
    delay: 250,
    data : function (param) { 
        var query = {
            search: param.term,
        } 
        return query;
        
    },
    processResults: function (data) {
        return {
            results: data
        }
    }
  }
});
});
</script>
@endsection