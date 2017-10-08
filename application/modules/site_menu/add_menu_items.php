<?php
include "connection.php";
$id=$_GET["id"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form name="form1" action="" method="post">
<table>

<tr>
<td>title</td>
<td><input type="text" name="t1"></td>
</tr>

<tr>
<td>link</td>
<td><input type="text" name="t2" value="#"></td>
</tr>



<tr>
<td colspan="2" align="center"><input type="submit" name="submit1" value="add menu"></td>
</tr>


</table>
</form>

<?php
if(isset($_POST["submit1"]))
{
mysqli_query($link,"insert into main_menu values('','$_POST[t1]','$_POST[t2]','$id')");
?>
<script type="text/javascript">
window.location="index2.php";
</script>

<?php
}

?>


</body>
</html>
