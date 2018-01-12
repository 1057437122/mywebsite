<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Redirect;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public $isAdmin = 0 ;
    public $user_id;
    public $page;//分页时每页显示数量
    public $theme;
    public $background ;
    public $front;
    public $title;
    public function __construct(){
    	//所有admin中的类都继承这个方法，一些仅有的变量都在这里进行设置
    	$this->page =  config('managesetting.page',15);
    	$this->theme = config('managesetting.theme','gentellela');
    	$this->background = config('managesetting.background','admin');
        $this->front = config('managesetting.front','front');
        $this->title = config('managesetting.title','SHENDU');
    	$this->middleware(function ($request, $next) {
    		//验证superadmin
	        $this->user= Auth::user();
	        $this->user_id = $this->user->id;
	        if($this->user->id == 1){
	        	$this->isAdmin = 1;
	        }
            View::share('isAdmin',$this->isAdmin);
            View::share('user',$this->user);
            View::share('title',$this->title);
            View::share('background',$this->background);
	        return $next($request);
	    });
        // DB::connection()->enableQueryLog();
        // DB::getQueryLog()
    }
    public function index(){
    	echo 'this is admin index';
    }
}