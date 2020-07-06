<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraHelp;
use App\Sales_order_model;
use App\Detail_sales_order_model;
use App\Master_produk_model;
use App\Master_customer_model;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $helper = new LaraHelp();
        $minggu_lalu = date("Y-m-d", strtotime(date('Y-m-d') . " - 6 days"));
        $hari_ini = date("Y-m-d");
        // dd($hari_ini);
        $tanggal_minggu_lalu = $helper->format_date_id($minggu_lalu) ." - ". $helper->format_date_id($hari_ini); 

        $sales =    Sales_order_model::select(DB::raw("GROUP_CONCAT(CONVERT(id, CHAR(20)) SEPARATOR '-') as id_detail_sales_order"), 'tanggal', DB::raw("COUNT(id) as value"))
                        ->whereBetween('tanggal', [$minggu_lalu, $hari_ini])
                        ->groupBy('tanggal')
                        ->get();

       
        
        $jumlah_produk = Master_produk_model::select()->count();
        $jumlah_customer = Master_customer_model::select()->count();
        $jumlah_sales_order = Sales_order_model::select()->count();

        // dd($sales);

       

        $pie_sales = [];
        $bar_sales = [];
        $label_bar_sales = [];
        $dataset_bar_sales = [];
        foreach($sales as $key => $data_sales){
            $color = $helper->rand_color();
            $pie_sales[$key] = [
                                    'value'=> $data_sales['value'],
                                    'color'=> $color,
                                    'highlight'=> $color,
                                    'label'=> $helper->format_date_id($data_sales['tanggal'])
                                ];
            // dd(explode('-',$data_sales['id_detail_sales_order']));
            $detail_sales = Master_produk_model::leftJoin('detail_sales_order as c', 
                                function($join) use($data_sales){
                                    $join->on('c.id_produk', '=', 'master_produk.id')
                                    ->whereIn('id_sales_order', explode('-',$data_sales['id_detail_sales_order']));
                                })
                                ->select('produk', DB::Raw('SUM(IFNULL( `kuantitas` , 0 )) as value'))
                                ->orderBy('produk','ASC')
                                ->groupBy('id_produk')
                                ->get();
            // dd($detail_sales);
            $detail_value_sales = [];                                                        
            foreach($detail_sales as $key2 => $data_detail_sales){
                $color_produk = $helper->rand_color();
                $detail_value_sales [$key2] = $data_detail_sales['value'];
                $label_bar_sales [$key2] = $data_detail_sales['produk'];
                $dataset_bar_sales[$key] = [
                                                "fillColor"           => $color_produk,
                                                "strokeColor"         => $color_produk,
                                                "pointColor"          => $color_produk,
                                                "pointStrokeColor"    => $color_produk,
                                                "pointHighlightFill"  => $color_produk,
                                                "pointHighlightStroke"=> $color_produk,
                                                "tension"=> 0
                                            ];
            }

            $dataset_bar_sales[$key]['label'] = $helper->format_date_id($data_sales['tanggal']);
            $dataset_bar_sales[$key]['data'] = $detail_value_sales;
            $bar_sales = [
                            "labels"=>$label_bar_sales,
                            "datasets"=>$dataset_bar_sales
                        ];
        }
        // dd($dataset_bar_sales);

        $pie_sales = json_encode($pie_sales);
        $bar_sales = json_encode($bar_sales);
        return view('home',compact('tanggal_minggu_lalu','pie_sales','bar_sales','jumlah_produk','jumlah_customer','jumlah_sales_order'));
    }
}
