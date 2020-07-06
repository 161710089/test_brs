<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_produk_model;
use DB;
use Session;
use Validator;
use LaraHelp;

class Master_produk extends Controller
{
    public function create(Request $r)
    {
        $data = $r->all();
        $validator = Validator::make($r->all(), [
          'id' => 'nullable|numeric'
        ]);

        if($validator->fails()){
          $msg = '{"pesan":"Terjadi kesalahan parameter","type":"error"}';
          return redirect()->back()->with(['msg'=>$msg]);
        }

        if (isset($data['id'])) {
          $produk = Master_produk_model::select()->where('id',$data['id'])->first();
        }

        return view('produk.produk_form',compact('produk'));
    }

    public function create_action(Request $r)
    {
    // dd(session()->all());
      $validator = Validator::make($r->all(), [
        'id' => 'nullable|numeric',
        'produk' => 'required|string',
        'kode_produk' => 'required|min:6',
        'harga' => 'required'
      ]);

      if($validator->fails()){
        $msg = '{"pesan":"Terjadi kesalahan parameter","type":"error"}';
        return redirect()->back()->with(['msg'=>$msg]);
      }

      $data = $r->all();
      $helper = new LaraHelp();
     
      DB::beginTransaction();
      try {
        $msg = '{"pesan":"Data Berhasil diproses","type":"success"}';
        
        if (isset($r->all()["id"])) {
          Master_produk_model::where("id",$data["id"])
                        ->update([
                                  "produk"=>$data["produk"],
                                  "kode_produk"=>$data["kode_produk"],
                                  "harga"=>$helper->decode_number($data["harga"])
                                ]);
        }else {
          Master_produk_model::insert([
                                "produk"=>$data["produk"],
                                "kode_produk"=>$data["kode_produk"],
                                "harga"=>$helper->decode_number($data["harga"])
                              ]);
          DB::commit();
          return redirect()->route('produk')->with(['msg' => $msg]);
        }
        DB::commit();
      } catch (\Exception $e) {
        // dd($e->getMessage());
        DB::rollback();
        $msg = '{"pesan":"Terjadi kesalahan","type":"error"}';
      }

      return redirect()->back()->with(['msg' => $msg]);
    }

    public function delete(Request $r)
    {

      $validator = Validator::make($r->all(), [
        'id' => 'nullable|numeric'
      ]);

      if($validator->fails()){
        $msg = '{"pesan":"Terjadi kesalahan parameter","type":"error"}';
        return redirect()->back()->with(['msg'=>$msg]);
      }

      $data = $r->all();

      DB::beginTransaction();
      try {
        $msg = '{"pesan":"Data berhasil dihapus","type":"success"}';
        Master_produk_model::where('id',$data['id'])->delete();
        DB::commit();

        return redirect()->back()->with(['msg' => $msg]);
      } catch (\Exception $e) {
        DB::rollback();
        $msg = '{"pesan":"Terjadi kesalahan","type":"error"}';

        return redirect()->back()->with(['msg' => $msg]);
      }


    }
}
