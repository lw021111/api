<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Student;
class ClassesController extends Controller
{
    public function create(){
    	return view('class/create');
    }

    public function createdo(){
    	$data=request()->input();
    	$info=Classes::create($data);
    	// dd($info);
    	if($info){
    		return redirect('class/index');
    	}
    }

    public function index(){

    	$info=Classes::where('c_status',1)->paginate(3);
    	return view('class/index',compact('info'));
    }

    public function del($id){
        $c_id=request()->id;
        $where=[
            ['c_id','=',$c_id]
        ];
        $res=Student::where($where)->first();
        if($res){
           echo "<script>alert('该班级下有学生存在，不允许删除');location='/class/index'</script>"; 
       }else{
            $info=Classes::where($where)->update(['c_status'=>2]);
            if($info){
                echo "<script>alert('删除成功');location='/class/index'</script>";
            }else{
                echo "<script>alert('删除失败');location='/class/index'</script>";
            }
        }
    }

    public function edit($id){
        $info=Classes::find($id);
        return view('class/edit',compact('info'));
    }

    public function update($id){
        $data=request()->input();
        $info=Classes::where('c_id',$id)->update($data);
        if($info){
            return redirect('class/index');
        }
    }

}
