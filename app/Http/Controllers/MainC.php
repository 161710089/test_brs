<?php

namespace App\Http\Controllers;

use Request;
use App\Master_produk;
use DB;
class MainC extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(){
        $url = Request::segment(2);
        switch($url){
            case 'produk':
              $label = "List Master Produk";
              return view('produk.produk_list',compact('label'));
            break;
            case 'customer':
              $label = "List Master Customer";
              return view('customer.customer_list',compact('label'));
            break;
            case 'suplier':
              $label = "List Master Suplier";
              return view('suplier.suplier_list',compact('label'));
            break;
            case 'sales_order':
              $label = "Sales Order";
              return view('sales_order.sales_order_list',compact('label'));
            break;
            case 'home':
              return view('home');
            break;
            default:
              return view('welcome');
            break;

        }
    }
}
