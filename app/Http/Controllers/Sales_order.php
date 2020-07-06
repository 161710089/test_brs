<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales_order_model;
use App\Detail_sales_order_model;
use DB;
use Validator;
use LaraHelp;

class Sales_order extends Controller
{

    public function create(Request $r)
    {
        $helper = new LaraHelp();
        $data = $r->all();
        $validator = Validator::make($r->all(), [
            'id' => 'nullable|numeric'
        ]);

        if($validator->fails()){
            $msg = '{"pesan":"Terjadi kesalahan parameter","type":"error"}';
            return redirect()->back()->with(['msg'=>$msg]);
        }

        $part_kode_sales_order = array(
            'SO',
            date('Ymd')
        );
        $kode_sales_order = implode('/', $part_kode_sales_order);
        $kode_sales_order .= '/'.$helper->get_auto_number('sales_order', 'kode_sales_order', $kode_sales_order);
        // dd($kode_sales_order);
        
        $detail_sales_order = '';
        if (isset($data['id'])) {
            $sales_order = Sales_order_model::select('sales_order.id','kode_sales_order', 'id_customer','customer','tanggal','total')
                            ->join('master_customer as b','id_customer','b.id')
                            ->where('sales_order.id',$data['id'])
                            ->first();
            $kode_sales_order = $sales_order->kode_sales_order;
            $detail_sales_order = Detail_sales_order_model::select('detail_sales_order.id as id_detail_sales_order','id_produk','produk','kuantitas','detail_sales_order.harga')
                                ->join('master_produk as b','id_produk','b.id')
                                ->where('id_sales_order',$sales_order['id'])->get();
            foreach ($detail_sales_order as $key => $datas) {
              $datas['total_perbarang'] = $helper->format_rupiah($datas['kuantitas'] * $datas['harga']);

                $datas['id_produk'] = $datas['produk']."<input name='id_produk[]' type=hidden value=".$datas["id"].">";
                $datas['kuantitas'] = "<input name='kuantitas[]' class='form-control' type=text value=".$datas["kuantitas"].">";
                $datas['harga'] = $helper->format_rupiah($datas['harga'])."<input name='harga[]' type=hidden value=".$datas["harga"].">";
                $detail_sales_order[$key] = $datas;
                $datas['action'] = "<button class='btn btn-danger btn-sm btn-remove-row'><i class='fa fa-minus'></i></button>";

            }
            $detail_sales_order = json_encode($detail_sales_order);
            // dd($detail_sales_order);

        }
      return view('sales_order.sales_order_form',compact('kode_sales_order','sales_order','detail_sales_order'));
    }

    public function create_action(Request $r)
    {
        $helper = new LaraHelp();
        $validator = Validator::make($r->all(), [
            'id_customer' => 'required|numeric',
            'tanggal' => 'required|date',
            'total' => 'required'
        ]);

        if($validator->fails()){
            // dd($validator->errors());
            $msg = '{"pesan":"Terjadi kesalahan parameter","type":"error"}';
            return redirect()->back()->with(['msg'=>$msg]);
        }

      $data = $r->all();
    //   dd($data);
      DB::beginTransaction();
      try {
        $msg = '{"pesan":"Data Berhasil diproses","type":"success"}';
        if (isset($r->all()["id"])) {
            Sales_order_model::where("id",$data["id"])
                        ->update([
                                  "id_customer"=>$data["id_customer"],
                                  "kode_sales_order"=>$data["kode_sales_order"],
                                  "tanggal"=>$data["tanggal"],
                                  "total"=>$helper->decode_number($data["total"])
                                ]);
            Detail_sales_order_model::where("id_sales_order",$data["id"])
                            ->delete();

                            $detail = [];
                            for ($i=0; $i < count($data['id_produk']); $i++) { 
                                $detail[$i] = [
                                    "id_produk"=>$data['id_produk'][$i],
                                    "kuantitas"=>$data["kuantitas"][$i],
                                    "harga"=>$helper->decode_number($data["harga"])[$i],
                                    "id_sales_order"=>$data['id']
                                ];
                            }
                      
        }else {
            $lastid =   Sales_order_model::insertGetId([
                                "id_customer"=>$data["id_customer"],
                                "kode_sales_order"=>$data["kode_sales_order"],
                                "tanggal"=>$data["tanggal"],
                                "total"=>$helper->decode_number($data["total"])
                              ]);
                        $detail = [];
                        for ($i=0; $i < count($data['id_produk']); $i++) { 
                            $detail[$i] = [
                                "id_produk"=>$data['id_produk'][$i],
                                "kuantitas"=>$data["kuantitas"][$i],
                                "harga"=>$helper->decode_number($data["harga"])[$i],
                                "id_sales_order"=>$lastid
                            ];
                        }
                        
        }

          Detail_sales_order_model::insert($detail);
          
          DB::commit();
          return redirect()->route('sales_order')->with(['msg' => $msg]);    
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
        Sales_order_model::where('id',$data['id'])->delete();
        Detail_sales_order_model::where('id_sales_order',$data['id'])->delete();
        DB::commit();

        return redirect()->back()->with(['msg' => $msg]);
      } catch (\Exception $e) {
        DB::rollback();
        $msg = '{"pesan":"Terjadi kesalahan","type":"error"}';

        return redirect()->back()->with(['msg' => $msg]);
      }
    }
}
