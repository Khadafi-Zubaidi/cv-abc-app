<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KategoriController extends Controller
{
    public function tampil_data_kategori_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data_tabel = Kategori::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin.tampil_data_kategori_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function cari_id_kategori($id){
        $data = Kategori::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_kategori_oleh_admin(Request $request){
        $data_perubahan = Kategori::find($request->id);
        $data_perubahan->nama_kategori = $request->nama_kategori;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function hapus_data_kategori_oleh_admin(Request $request){
        $data_dihapus = Kategori::find($request->id);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function tambah_data_kategori_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_admin.tambah_data_kategori_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function simpan_data_kategori_baru_oleh_admin(Request $request){
        if (session()->has('LoggedAdmin')){
            $request->validate([
                'nama_kategori'=>'required|unique:kategoris',
            ],[
                'nama_kategori.required'=>'Nama Kategori tidak boleh kosong',
                'nama_kategori.unique'=>'Nama Kategori tersebut sudah digunakan',
            ]);
            $data_baru = new Kategori();
            $data_baru->nama_kategori = $request->nama_kategori;
            $data_baru->save();
            return redirect('tampil_data_kategori_oleh_admin');
        }else{
            return view('login.login_admin');
        }
    }
}
