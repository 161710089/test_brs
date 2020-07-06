<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Lara_helpers {
    function format_rupiah($str){
        return 'Rp. '. number_format($str, 2, ',', '.');
    }

    function decode_number($str){
        $patterns = array();
        $patterns[0] = '/Rp. /';
        $patterns[1] = '/\./';
        $patterns[2] = '/,/';
        $replacements = array();
        $replacements[0] = '';
        $replacements[1] = '';
        $replacements[2] = '.';
        return preg_replace($patterns, $replacements, $str);
    }

    function get_auto_number($table, $field, $prefiks){
        $result = DB::table($table)
                ->select($field)
                ->orderBy($field, 'DESC')
                ->where($field,"like","%".$prefiks."%")
                ->first();
        if ($result){
            $part = explode('/', $result->$field);
            $number = $part[count($part) - 1] + 1;
            $count = strlen($number);
            $temp = '0000';
            $number = substr($temp, 1,strlen($temp) - $count).$number;
            return $number;
        } else {
            return '0001';
        }
    }

    function format_date_id($str){                  
        if (empty($str)){
            return '';
        }
        else {
            $date = explode('-', $str);
        $day = $date[2];
        $year = $date[0];
        switch ($date[1]) {
            case 1:
                $month = 'Januari';
                break;
            case 2:
                $month = 'Februari';
                break;
            case 3:
                $month = 'Maret';
                break;
            case 4:
                $month = 'April';
                break;
            case 5:
                $month = 'Mei';
                break;
            case 6:
                $month = 'Juni';
                break;
            case 7:
                $month = 'Juli';
                break;
            case 8:
                $month = 'Agustus';
                break;
            case 9:
                $month = 'September';
                break;
            case 10:
                $month = 'Oktober';
                break;
            case 11:
                $month = 'November';
                break;
            case 12:
                $month = 'Desember';
                break;
            default:
                # code...
                break;
        }
        return @$day.' '.@$month.', '.@$year;    
        }
    }

    function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
    

}