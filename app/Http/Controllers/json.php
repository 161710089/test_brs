<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_produk_model;
use App\Master_customer_model;
use App\Master_suplier_model;
use App\Sales_order_model;

use DB;
class json extends Controller
{
    public function produk(){
      $json = Master_produk_model::select()->get();
      $json2 = array();

      foreach($json as $key => $datas){
        $datas->action = " <div style='display:inline-flex'>
                             <a href='".route("produk_create","id=".$datas->id)."' class='btn btn-info'><i class='fa fa-edit'></i> Edit</a>
                             &nbsp;
                             <form action='".route("produk_delete","id=".$datas->id)."' method='post' >
                                <button type='submit' class='btn btn-danger'  >".csrf_field().method_field('delete')."<i class='fa fa-trash'></i> Delete</button>
                             </form>
                           </div>"
                            ;
                            // onclick='confirm(\"tes\")'
        $json2[] = $datas;
      }

      $data['data'] = $json2;
      echo json_encode($data);
    }

    public function customer(){
      $json = Master_customer_model::select()->get();
      $json2 = array();

      foreach($json as $key => $datas){
        $datas->action = " <div style='display:inline-flex'>
                              <a href='".route("customer_create","id=".$datas->id)."' class='btn btn-info'><i class='fa fa-edit'></i> Edit</a>
                              &nbsp;
                              <form action='".route("customer_delete","id=".$datas->id)."' method='post' >
                                <button type='submit' class='btn btn-danger'  >".csrf_field().method_field('delete')."<i class='fa fa-trash'></i> Delete</button>
                              </form>
                           </div>"
                            ;
        $json2[] = $datas;
      }

      $data['data'] = $json2;
      echo json_encode($data);
    }

    public function suplier(){
      $json = Master_suplier_model::select()->get();
      $json2 = array();

      foreach($json as $key => $datas){
        $datas->action = " <div style='display:inline-flex'>
                             <a href='".route("suplier_create","id=".$datas->id)."' class='btn btn-info'>Edit</a>
                             &nbsp;
                             <form action='".route("suplier_delete","id=".$datas->id)."' method='post' >
                                <button type='submit' class='btn btn-danger'  >".csrf_field().method_field('delete')." Delete</button>
                             </form>
                           </div>"
                            ;
        $json2[] = $datas;
      }

      $data['data'] = $json2;
      echo json_encode($data);
    }

    public function sales_order(){
      $json = Sales_order_model::select('sales_order.id','customer','tanggal','total')
              ->leftJoin('master_customer as b','id_customer','b.id')        
              ->get();
      $json2 = array();

      foreach($json as $key => $datas){
        $datas->action = " <div style='display:inline-flex'>
                             <a href='".route("sales_order_create","id=".$datas->id)."' class='btn btn-info'><i class='fa fa-edit'></i> Edit</a>
                             &nbsp;
                             <form action='".route("sales_order_delete","id=".$datas->id)."' method='post' >
                                <button type='submit' class='btn btn-danger'  >".csrf_field().method_field('delete')."<i class='fa fa-trash'></i> Delete</button>
                             </form>
                           </div>"
                            ;
        $json2[] = $datas;
      }

      $data['data'] = $json2;
      echo json_encode($data);
    }

}
