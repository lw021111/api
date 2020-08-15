<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Student;
class StudentController extends Controller
{
    public function create(){
    	$info=Classes::get();
    	return view('student/create',compact('info'));
    }

    public function createdo(){
    	$data=request()->input();
    	$info=Student::create($data);
    	if($info){
    		return redirect('student/index');
    	}
    }

    public function index(){
        $res=Classes::get();
        $s_name=request()->s_name??'';
        $c_id=request()->c_id??'';
        $s_sex=request()->s_sex??'';
        $age1=request()->age1??'';
        $age2=request()->age2??'';
        $where=[];
        if($s_name){
            $where[]=['s_name','like',"%$s_name%"];
        }
        if($c_id){
            $where[]=['student.c_id','=',"$c_id"];
        }
        if($s_sex){
            $where[]=['s_sex','=',"$s_sex"];
        }
        if($age1){
            $where[]=['s_age','>=',"$age1"];
        }
        if($age2){
            $where[]=['s_age','<=',"$age2"];
        }
    	$info=Student::leftjoin("classes","student.c_id","=","classes.c_id")
                        ->where('s_status',1)->where($where)
                        ->orderby('s_id','desc')
                        ->paginate(3);
        
    	return view('student/index',compact('info','res','age1','age2'));
    }

    public function del($id){
        $s_id=request()->id;
        $where=[
            ['s_id','=',$s_id]
        ];
        $info=Student::where($where)->update(['s_status'=>2]);
        
        if($info){
            echo "<script>alert('删除成功');location='/student/index'</script>";
        }else{
            echo "<script>alert('删除失败');location='/student/index'</script>";
        }
    }

    public function edit($id){
        $res=Student::find($id);
        $info=Classes::get();
        return view('student/edit',compact('res','info'));
    }

    public function update($id){
        $data=request()->input();
        $info=Student::where('s_id',$id)->update($data);
        if($info){
            return redirect('student/index');
        }
    }


}
