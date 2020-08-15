<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生添加</title>
</head>
<body>
	<form action="{{url('student/createdo')}}" method="post">
		<table border="1">
			<tr>
				<td>姓名: </td>
				<td><input type="text" name="s_name"></td>
			</tr>
			<tr>
				<td>性别: </td>
				<td>
					<input type="radio" name="s_sex" value="1">男
					<input type="radio" name="s_sex" value="2">女
				</td>
			</tr>
			<tr>
				<td>年龄: </td>
				<td><input type="text" name="s_age"></td>
			</tr>
			<tr>
				<td>班级: </td>
				<td>
					<select name="c_id">
						<option>--请选择--</option>
						@foreach($info as $v)
						<option value="{{$v->c_id}}">{{$v->c_name}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>