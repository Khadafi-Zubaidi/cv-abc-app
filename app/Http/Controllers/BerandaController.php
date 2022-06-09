<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function tampil_data_produk_di_beranda(){
        $daftar_produk = DB::table('produks')
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
            'DaftarProduk'=>$daftar_produk,
        ];
        return view('beranda.beranda',$data);
    }
}
