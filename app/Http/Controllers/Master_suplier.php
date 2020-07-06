<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_suplier_model;
use Validator;
use DB;
class Master_suplier extends Controller
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
        $suplier = Master_suplier_model::select()->where('id',$data['id'])->first();
      }

      return view('suplier.suplier_form',compact('suplier'));
    }

    public function create_action(Request $r)
    {
      $validator = Validator::make($r->all(), [
        'id' => 'nullable|numeric',
        'suplier' => 'required|string',
        'kode_suplier' => 'required|string',
        'alamat' => 'required|string',
        'no_telepon' => 'required|string'
      ]);

      if($validator->fails()){
        $msg = '{"pesan":"Terjadi kesalahan parameter","type":"error"}';
        return redirect()->back()->with(['msg'=>$msg]);
      }

      $data = $r->all();
      DB::beginTransaction();
      try {
        $msg = '{"pesan":"Data Berhasil diproses","type":"success"}';
        if (isset($r->all()["id"])) {
          Master_suplier_model::where("id",$data["id"])
                        ->update([
                                  "suplier"=>$data["suplier"],
                                  "kode_suplier"=>$data["kode_suplier"],
                                  "alamat"=>$data["alamat"],
                                  "no_telepon"=>$data["no_telepon"]
                                ]);
        }else {
          Master_suplier_model::insert([
                                "suplier"=>$data["suplier"],
                                "kode_suplier"=>$data["kode_suplier"],
                                "alamat"=>$data["alamat"],
                                "no_telepon"=>$data["no_telepon"]
                              ]);
          DB::commit();
          return redirect()->route('suplier')->with(['msg' => $msg]);
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
        Master_suplier_model::where('id',$data['id'])->delete();
        DB::commit();

        return redirect()->back()->with(['msg' => $msg]);
      } catch (\Exception $e) {
        DB::rollback();
        $msg = '{"pesan":"Terjadi kesalahan","type":"error"}';

        return redirect()->back()->with(['msg' => $msg]);
      }
    }

}
