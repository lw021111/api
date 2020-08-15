<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>班级修改</title>
</head>
<body>
	<form action="{{url('class/update/'.$info->c_id)}}" method="post">
		<table border="1">
			<tr>
				<td>班级: </td>
				<td><input type="text" name="c_name" value="{{$info->c_name}}"></td>
			</tr>
			<tr>
				<td><input type="submit" value="修改"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>