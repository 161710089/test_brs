<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_customer_model;
use App\Master_produk_model;

class Global_controller extends Controller
{
    public function select2_customer(Request $r){
        $req = $r->all();
        $data = array();
      
        $master_customer = Master_customer_model::select('id','customer as text');
        if (isset($req['search'])){
            if (!empty($req['search']) || !is_null($req['search']) || $req['search'] != ''){
                $master_customer->where("customer","like","%".$req['search']."%");
            }
        }
        $data = $master_customer->get();
        $result['results'] = $data;
        echo json_encode($result);
    }

    public function select2_produk(Request $r){
        $req = $r->all();
        $data = array();
      
        $master_produk = Master_produk_model::select('id','produk as text');
        if (isset($req['search'])){
            if (!empty($req['search']) || !is_null($req['search']) || $req['search'] != ''){
                $master_produk->where("produk","like","%".$req['search']."%");
            }
        }
        $data = $master_produk->get();
        $result['results'] = $data;
        echo json_encode($result);
    }

    public function get_harga(Request $r){
        $data = $r->all(); 
        
        if (empty($data['id_produk'])){
            $row['harga'] = '0,00';
        } else {
            $row = Master_produk_model::select('harga')->where('id',$data['id_produk'])->first();

            if (empty($row)){
                $row['harga'] = '0,00';
            }
        }

        echo json_encode($row);
    }
}
