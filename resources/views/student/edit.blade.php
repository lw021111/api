<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生修改</title>
</head>
<body>
	<form action="{{url('student/update/'.$res->s_id)}}" method="post">
		<table border="1">
			<tr>
				<td>姓名: </td>
				<td><input type="text" name="s_name" value="{{$res->s_name}}"></td>
			</tr>
			<tr>
				<td>性别: </td>
				<td>
				@if($res->s_sex==1)
					<input type="radio" name="s_sex" value="1" checked>男
					<input type="radio" name="s_sex" value="2">女
				@else
					<input type="radio" name="s_sex" value="1">男
					<input type="radio" name="s_sex" value="2" checked>女
				@endif
				</td>
			</tr>
			<tr>
				<td>年龄: </td>
				<td><input type="text" name="s_age" value="{{$res->s_age}}"></td>
			</tr>
			<tr>
				<td>班级: </td>
				<td>
					<select name="c_id">
						<option>--请选择--</option>
						@foreach($info as $v)
						<option value="{{$v->c_id}}" {{$v->c_id==$res->c_id ? "selected" : ''}}>{{$v->c_name}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="修改"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>