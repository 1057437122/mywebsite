<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Redirect;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = DB::table('categories')->orderBy('id','desc')->paginate($this->page);
        $total_page = ceil($categories->total()/$this->page);
        $start_page = isset($_GET['page']) ? $_GET['page'] : 1 ;
        
        return view('admin.'.$this->theme.'.categoryindex',['categories'=>$categories,'start_page'=>$start_page,'total_page'=>$total_page,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate( $request ,[
                'name'=>'required',
                ]);
        $if_exists = DB::table('categories')->where('name',$request->get('name'))->first();
        if($if_exists){
            echo '添加失败名称已经存在';
        }else{
            DB::table('categories')->insert(['name'=>$request->get('name'),'create_user_id'=>$this->user_id]);
            echo '成功添加';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate( $request ,[
                'name'=>'required',
                ]);
        mylog('name:'.$request->get('name'));
        $if_exists = DB::table('categories')->where('name',$request->get('name'))->first();
        if($if_exists){
            echo '修改失败 名称已经存在';
        }else{
            $ret = DB::table('categories')->where('id',$id)->update(['name'=>$request->get('name')]);
            if($ret)
                echo '成功修改';
            else
                echo '修改失败';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        
        $ret = DB::table('categories')->where('id',$id)->delete();
        if($ret)
            echo '删除成功';
        else
            echo '没有这个分类';
        
    }
}
