<?php

namespace App\Http\Controllers\admin;
use App\Siswa;
use Validator, Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DataTables as dt;
class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $siswa = Siswa::all();
        //  return view('admin.siswa.siswa',compact('siswa'))
        //     ->with('i');
        return view('admin.siswa.siswa');
    }
    public function json_siswa()
    {
        $data = Siswa::all();
        
        return dt::of($data)->addColumn('action', function ($data)
        {
            return ' 
            <a data-toggle="modal" id="edit" data-target="#modalEdit" class="btn btn-success" data-id="'.$data->id_siswa.'" data-nis="'.$data->nis.'"
            data-nama = "'.$data->nama.'" data-alamat="'.$data->alamat.'" data-no_telepon = "'.$data->no_telepon.'" onclick="fungsiEdit()">Edit</a> 
                                        
                                        
            <a href="'.route("siswa.delete", $data->nis ).'" class="btn btn-danger" onclick="return confirm("Yakin Hapus?")">Hapus</a> 
            ';
        })->rawColumns(['action'])
        ->make(true);
       
    }
    public function json_siswa_by_id($id_siswa)
    {
        $data = Siswa::where('id_siswa',$id_siswa)->first();
        return Response::json($data);
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
            'nis' => 'required|min:5',
            'nama' => 'required|min:5',
            'alamat' => 'required|min:5',
            'no_telepon' => 'required|min:5',
         ], $messages);
         if(!$validator->fails()){
            Siswa::create($request->all());
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Ditambah');
         }else{
            return redirect()->route('siswa.index')->withErrors($validator)->withInput();
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
    public function update(Request $request, $nis)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min'=>':attribute minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];
         $validator =  Validator::make($request->all(), [
            'nis' => 'required|min:5',
            'nama' => 'required|min:5',
            'alamat' => 'required|min:5',
            'no_telepon' => 'required|min:5',
         ], $messages);
         if(!$validator->fails()){
            $siswa = Siswa::where('nis', $nis);
            $siswa->update([
                'nama'=> $request->nama,
                'alamat'=> $request->alamat,
                'no_telepon'=> $request->no_telepon,
            ]);
            
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Disunting');
         }else{
            return redirect()->route('siswa.index')->withErrors($validator)->withInput();
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nis)
    {
        $siswa = Siswa::where('nis', $nis);
        $siswa->delete();
        
        return redirect()->route('siswa.index')->with('success','Post deleted successfully');
        
    }
}
