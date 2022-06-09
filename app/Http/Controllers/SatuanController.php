<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function tampil_data_satuan_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data_tabel = Satuan::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin.tampil_data_satuan_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function cari_id_satuan($id){
        $data = Satuan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_satuan_oleh_admin(Request $request){
        $data_perubahan = Satuan::find($request->id);
        $data_perubahan->nama_satuan = $request->nama_satuan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function hapus_data_satuan_oleh_admin(Request $request){
        $data_dihapus = Satuan::find($request->id);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function tambah_data_satuan_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_admin.tambah_data_satuan_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function simpan_data_satuan_baru_oleh_admin(Request $request){
        if (session()->has('LoggedAdmin')){
            $request->validate([
                'nama_satuan'=>'required|unique:satuans',
            ],[
                'nama_satuan.required'=>'Nama Satuan tidak boleh kosong',
                'nama_satuan.unique'=>'Nama Satuan tersebut sudah digunakan',
            ]);
            $data_baru = new Satuan();
            $data_baru->nama_satuan = $request->nama_satuan;
            $data_baru->save();
            return redirect('tampil_data_satuan_oleh_admin');
        }else{
            return view('login.login_admin');
        }
    }
}
