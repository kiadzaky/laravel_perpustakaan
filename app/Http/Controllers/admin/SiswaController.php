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
use Illuminate\Support\Str;
class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uuid = Str::uuid();
        
        return view('admin.siswa.siswa')->with('uuid', $uuid);
    }
    public function json_siswa()
    {
        $data = Siswa::all();
        
        return dt::of($data)->addColumn('action', function ($data)
        {
            return ' 
            <a id="edit" data-target="#modalEdit" class="btn btn-success" data-id="'.$data->id_siswa.'" data-nis="'.$data->nis.'"
            data-nama = "'.$data->nama.'" data-alamat="'.$data->alamat.'" data-no_telepon = "'.$data->no_telepon.'" onclick = "fungsiEdit("'.$data->nis.'")">Edit</a> 
                                        
                                        
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
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min'=>':attribute minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];
         $validator =  Validator::make($request->all(), [
            'nis' => 'required|min:3',
            'nama' => 'required|min:5',
            'alamat' => 'required|min:5',
            'no_telepon' => 'required|min:5',
            'id_siswa' => 'required|min:20',
         ], $messages);
        //  print_r($request->all());
         if(!$validator->fails()){
            Siswa::create($request->all());
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Ditambah');
         }else{
            return redirect()->route('siswa.index')->withErrors($validator)->withInput();
         }
    }
    public function update(Request $request, $nis)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min'=>':attribute minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];
         $validator =  Validator::make($request->all(), [
            'nis' => 'required|min:3',
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
