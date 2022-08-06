<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function tampil_data_produk_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data_tabel = DB::table('produks')
                            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
                            ->join('satuans', 'produks.id_satuan', '=', 'satuans.id')
                            ->select('produks.id',
                                     'produks.nama_produk',
                                     'kategoris.nama_kategori',
                                     'satuans.nama_satuan',
                                     'produks.jumlah_stok',
                                     'produks.harga_satuan',
                                     'produks.foto_produk',)
                            ->orderBy('produks.id', 'asc')
                            ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin.tampil_data_produk_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function cari_id_produk($id){
        $data = Produk::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_produk_oleh_admin(Request $request){
        $data_perubahan = Produk::find($request->id);
        $data_perubahan->nama_produk = $request->nama_produk;
        $data_perubahan->jumlah_stok = $request->jumlah_stok;
        $data_perubahan->harga_satuan = $request->harga_satuan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function hapus_data_produk_oleh_admin(Request $request){
        $data_dihapus = Produk::find($request->id);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function tambah_data_produk_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data_kategori=DB::table('kategoris')
                                    ->select(
                                        'kategoris.id',   
                                        'kategoris.nama_kategori'
                                    )
                                    ->orderBy('kategoris.id', 'asc')->get();
            $data_satuan=DB::table('satuans')
                                    ->select(
                                        'satuans.id',   
                                        'satuans.nama_satuan'
                                    )
                                    ->orderBy('satuans.id', 'asc')->get();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataKategori'=>$data_kategori,
                'DataSatuan'=>$data_satuan,
            ];
            return view('tambah_data_oleh_admin.tambah_data_produk_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function simpan_data_produk_baru_oleh_admin(Request $request){
        if (session()->has('LoggedAdmin')){
            $request->validate([
                'id_kategori'=>'required',
                'id_satuan'=>'required',
                'nama_produk'=>'required',
                'jumlah_stok'=>'required',
                'harga_satuan'=>'required',
            ],[
                'id_kategori.required'=>'Kategori tidak boleh kosong',
                'id_satuan.required'=>'Satuan tidak boleh kosong',
                'nama_produk.required'=>'Nama Produk tidak boleh kosong',
                'jumlah_stok.required'=>'Jumlah Stok tidak boleh kosong',
                'harga_satuan.required'=>'Harga Satuan tidak boleh kosong',
                
            ]);
            $data_baru = new Produk();
            $data_baru->id_kategori = $request->id_kategori;
            $data_baru->id_satuan = $request->id_satuan;
            $data_baru->nama_produk = $request->nama_produk;
            $data_baru->jumlah_stok = $request->jumlah_stok;
            $data_baru->harga_satuan = $request->harga_satuan;
            $data_baru->save();
            return redirect('tampil_data_produk_oleh_admin');
        }else{
            return view('login.login_admin');
        }
    }

    public function simpan_perubahan_data_foto_produk_oleh_admin(Request $request){
        if($request->hasfile('file')){
            $data_foto_diperbaharui = Produk::find($request->id3);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,bmp,png,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_produk'),$filename);
            $data = $filename;
            $data_foto_diperbaharui->foto_produk = $data;
            $data_foto_diperbaharui->save();
            return response()->json('Foto Telah Disimpan'); 
        }
    }

    public function tampil_data_produk_versi_2_oleh_admin(){
        if (session()->has('LoggedAdmin')){
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data_tabel = DB::table('produks')
                            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
                            ->join('satuans', 'produks.id_satuan', '=', 'satuans.id')
                            ->select('produks.id',
                                     'produks.nama_produk',
                                     'kategoris.nama_kategori',
                                     'satuans.nama_satuan',
                                     'produks.jumlah_stok',
                                     'produks.harga_satuan',
                                     'produks.foto_produk',)
                            ->orderBy('produks.id', 'asc')
                            ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin.tampil_data_produk_versi_2_oleh_admin',$data);
        }else{
            return view('login.login_admin');
        }
    }

    public function tampil_data_kategori(){
        $data_kategori = DB::table('kategoris')
                            ->pluck('id','nama_kategori');
        return response()->json($data_kategori);
    }

    public function simpan_perubahan_data_kategori_pada_data_produk_oleh_admin_data(Request $request){
        $data_perubahan = Produk::find($request->id);
        $data_perubahan->id_kategori = $request->id_kategori;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }
}
