<?php

use Illuminate\Database\Seeder;
use App\Master_produk_model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class seedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "INSERT INTO tbl_menu (menu,url,icon,is_aktif,is_main_menu) 
                        VALUES 
                        ('Produk','produk','fa fa-shopping-cart','y',0),
                        ('Customer','customer','fa fa-users','y',0),
                        ('Sales Order','sales_order','fa fa-user','y',0)
                        
                        ";
        DB::unprepared($sql);  
        $sql = "INSERT INTO tbl_user_level (id,level) VALUES(1,'superadmin')";
        
        $sql = "INSERT INTO tbl_hak_akses (id_menu,id_level) 
                        VALUES 
                        (1,1),
                        (2,1),
                        (3,1)
                        ";

        DB::unprepared($sql);
        $pass = bcrypt('admin123');
        $sql = "INSERT INTO users (id,name,email,password,id_level) VALUES(1,'Admin','admin@gmail.com','".$pass."',1)";
        DB::unprepared($sql);
        $sql = "INSERT INTO master_produk (id,produk,kode_produk,harga) VALUES(1,'Teh Pucuk','TPC001',3000)";
        DB::unprepared($sql);
        $sql = "INSERT INTO master_customer (id,customer,alamat,no_telepon) VALUES(1,'PT. Makmur Rezeki','Jl.Margahayu Raya','081337437678')";
        DB::unprepared($sql);
      
    }
}
