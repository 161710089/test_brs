<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Master_customer_model;

class Master_customer extends Controller
{
    public function index() {

    }

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
        $customer = Master_customer_model::select()->where('id',$data['id'])->first();
      }

      return view('customer.customer_form',compact('customer'));
    }

    public function create_action(Request $r)
    {
      $validator = Validator::make($r->all(), [
        'id' => 'nullable|numeric',
        'customer' => 'required|string',
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
          Master_customer_model::where("id",$data["id"])
                        ->update([
                                  "customer"=>$data["customer"],
                                  "alamat"=>$data["alamat"],
                                  "no_telepon"=>$data["no_telepon"]
                                ]);
        }else {
          Master_customer_model::insert([
                                "customer"=>$data["customer"],
                                "alamat"=>$data["alamat"],
                                "no_telepon"=>$data["no_telepon"]
                              ]);
          DB::commit();
          return redirect()->route('customer')->with(['msg' => $msg]);
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
        Master_customer_model::where('id',$data['id'])->delete();
        DB::commit();

        return redirect()->back()->with(['msg' => $msg]);
      } catch (\Exception $e) {
        DB::rollback();
        $msg = '{"pesan":"Terjadi kesalahan","type":"error"}';

        return redirect()->back()->with(['msg' => $msg]);
      }
    }
}
