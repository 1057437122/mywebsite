<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Library\Ucpaas;

if( ! function_exists('mylog') ){
	function mylog($data_str_to_log){
		if(is_array($data_str_to_log)) $data_str_to_log = 'ARRAY:'.json_encode($data_str_to_log);
		if(is_object($data_str_to_log)) $data_str_to_log = 'OBJECT:'.json_encode($data_str_to_log);
		Log::debug(date('H:i:s',time()).' --- '.$data_str_to_log);
	}
}
if( !function_exists('http_get') ){
	function http_get($url){
		$curl      = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_NOBODY, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, FALSE);
		$data = curl_exec($curl);
		// curl_exec($curl);
		$httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
		curl_close($curl);
	    return $httpCode;
	}
}
if( !function_exists('http_post') ){
	function http_post($url,$data){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close ( $ch );
		return $result;
	}
}
if( ! function_exists('timestamp_date') ){
	function timestamp_date($date,$flag='start'){
		$split_date = explode('-',$date);
		if($flag=='start'){
			$date= mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]);
		}else{
			$date= mktime(23,59,59,$split_date[1],$split_date[2],$split_date[0]);
		}
		return $date;
	}
}


if(! function_exists('getMillisecond')){
	function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }
}
if( !function_exists('today_start_timestamp') ){
	function today_start_timestamp(){
		$dt = date('Y-m-d',time());
		format_timestamp_from_date($dt,'start');
		return $dt;
	}
}
if( !function_exists('today_end_timestamp') ){
	function today_end_timestamp(){
		$dt = date('Y-m-d',time());
		format_timestamp_from_date($dt,'end');
		return $dt;
	}
}
if( !function_exists('format_timestamp_from_date')){
	function format_timestamp_from_date(&$date,$flag='start'){
		$split_date = explode('-',$date);
		if($flag=='start'){
			$date= mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]);
		}else{
			$date= mktime(23,59,59,$split_date[1],$split_date[2],$split_date[0]);
		}
	}
}
if( !function_exists('format_mac') ){
	function format_mac($mac){
		/*
		* 返回以冒号分隔的小写MAC
		*/
		$mac=strtolower($mac);
		$amac=str_split($mac,2);
		$smac=join(":",$amac);
		return $smac;
	}
}

if( !function_exists('array_index_shift')){
	function array_index_shift($index,$arr){
		if(isset($arr[$index]))
			unset($arr[$index]);
		return array_values($arr);
	}
}
