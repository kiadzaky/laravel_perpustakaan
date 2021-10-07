<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
namespace App\Http\Controllers\admin;
use App\Buku;
use Validator, Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DataTables as dt;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = [];
        $data['uuid'] = Str::uuid();
        $data['judul'] = 'Buku';
        
        return view('admin.buku.buku')->with($data);
    }

    public function json_buku()
    {
        $data = Buku::all();
        
        return dt::of($data)->addColumn('action', function ($data)
        {
            return ' 
            <a id="edit" data-target="#modalEdit" class="btn btn-success" data-id="'.$data->id_buku.'"
            data-judul_buku = "'.$data->judul_buku.'" data-penerbit="'.$data->penerbit.'" data-tahun_terbit = "'.$data->tahun_terbit.'" onclick="fungsiEdit()">Edit</a> 
                                        
                                        
            <a href="'.route("buku.delete", $data->id_buku ).'" class="btn btn-danger" id="btn_hapus">Hapus</a> 
            ';
        })->rawColumns(['action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min'=>':attribute minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];
         $validator =  Validator::make($request->all(), [
            'judul_buku' => 'required|min:3',
            'penerbit' => 'required|min:5',
            'tahun_terbit' => 'required',
            'id_buku' => 'required|min:20',
         ], $messages);
        //  print_r($request->all());
         if(!$validator->fails()){
            Buku::create($request->all());
            return redirect()->route('buku.index')->with('success', 'Data Berhasil Ditambah');
         }else{
            return redirect()->route('buku.index')->withErrors($validator)->withInput();
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_buku)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min'=>':attribute minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];
         $validator =  Validator::make($request->all(), [
            'judul_buku' => 'required|min:3',
            'penerbit' => 'required|min:5',
            'tahun_terbit' => 'required',
         ], $messages);
         if(!$validator->fails()){
            $siswa = Buku::where('id_buku', $id_buku);
            $siswa->update([
                'judul_buku'=> $request->judul_buku,
                'penerbit'=> $request->penerbit,
                'tahun_terbit'=> $request->tahun_terbit,
            ]);
            return redirect()->route('buku.index')->with('success', 'Data Berhasil Disunting');
         }else{
            return redirect()->route('buku.index')->withErrors($validator)->withInput();
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_buku)
    {
        $siswa = Buku::where('id_buku', $id_buku);
        $siswa->delete();
        
        return redirect()->route('buku.index')->with('success','Post deleted successfully');
    }
}
