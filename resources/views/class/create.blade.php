<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>班级添加</title>
</head>
<body>
	<form action="{{url('class/createdo')}}" method="post">
		<table border="1">
			<tr>
				<td>班级: </td>
				<td><input type="text" name="c_name"></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>