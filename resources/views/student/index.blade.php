<form>
	<input type="text" name="s_name" placeholder="请输入姓名...">    
	班级:<select name="c_id">
		<option value="0">--请选择--</option>
		@foreach($res as $v)
			<option value="{{$v->c_id}}">{{$v->c_name}}</option>
		@endforeach
	</select> 
	性别:<input type="radio" name="s_sex" value="1">男
		<input type="radio" name="s_sex" value="2">女<br>
	年龄:<input type="text" name="age1" value="{{$age1}}" style="width:50px;"> -
		<input type="text" name="age2" value="{{$age2}}" style="width:50px;">
	<input type="submit" value="搜索">
</form>

<table border="1">
	<tr>
		<td>id</td>
		<td>姓名</td>
		<td>性别</td>
		<td>年龄</td>
		<td>班级</td>
		<td>操作</td>
	</tr>
	@foreach($info as $v)
	<tr>
		<td>{{$v->s_id}}</td>
		<td>{{$v->s_name}}</td>
		<td>@if($v->s_sex==1) 男 @else 女 @endif</td>
		<td>{{$v->s_age}}</td>
		<td>{{$v->c_name}}</td>
		<td>
			<a href="{{url('student/del/'.$v->s_id)}}">删除</a>
			<a href="{{url('student/edit/'.$v->s_id)}}">修改</a>
		</td>
	</tr>
	@endforeach
</table>
{{$info->links()}}