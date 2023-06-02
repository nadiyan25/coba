<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MStokbarang extends Model
{
    function viewData()
    {
        $query = DB::table('tb_stokbarang')
        ->select("kode As kode_Stokbarang", "nama barang As namabarang_Stokbarang", "harga As harga_Stokbarang", 
        "stok As stok_Stokbarang", "merk As merk_Stokbarang")
        ->orderBy("kode")
        ->get();

        return $query;
    }

    function detailData($parameter)
    {
        $query = DB::table('tb_stokbarang')
        ->select("kode As kode_Stokbarang", "namabarang As namabarang_Stokbarang", "harga As harga_Stokbarang", 
        "stok As stok_Stokbarang", "merk As merk_Stokbarang")
        //->where("MD5(nik)","=",$parameter)

        // gunakan MD5(nik)
        //->whereRaw("MD5(nik) = '$parameter'")

        //->where(DB::raw("MD5(nik)"),"=",$parameter)

        //gunakan base64(nik)
        ->where(DB::raw("TO_BASE64(kode)"),"=",$parameter)

        ->orderBy("kode")
        ->get();

        return $query;
    }

    //fungsi untuk delete data
    function deleteData($parameter)
    {
        DB::table("tb_stokbarang")
        ->where(DB::raw("TO_BASE64(kode)"),"=",$parameter)
        ->delete();
    }

    //buat fungsi untuk simpan data
    function saveData($kode, $namabarang, $harga, $stok, $merk)
    {
        DB::table("tb_stokbarang")
        ->insert([
            "kode" => $kode,
            "nama" => $namabarang,
            "harga" => $harga,
            "stok" => $stok,
            "merk" => $merk,
        ]);
    }

    //buat fungsi untuk cek ubah data
    function checkUpdate($kode_lama, $kode_baru)
    {
        $query = DB::table("tb_stokbarang")
        ->select("kode")
        ->where("kode", "=", $kode_baru)
        ->where(DB::raw("TO_BASE64(kode)"), "!=", $kode_lama)
        ->get();

        return $query;
    }
    //buat fungsi untuk ubah data
    function updateData($kode, $namabarang, $harga, $stok, $merk, $kode_lama)
    {
        DB::table("tb_stokbarang")
        ->where(DB::raw("TO_BASE64(kode)"),"=",$kode_lama)
        ->update([
            "kode" => $kode,
            "nama" => $namabarang,
            "harga" => $harga,
            "stok" => $stok,
            "merk" => $merk,
        ]);
    }
}
