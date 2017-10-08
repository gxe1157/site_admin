<?php
include "connection.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
$id=$_GET["id"];
mysqli_query($link,"delete from main_menu where id=$id");
delete_menu_records($id);

function delete_menu_records($id)
{
    include "connection.php";
$res=mysqli_query($link,"select * from main_menu where parentid=$id");
while($row=mysqli_fetch_array($res))
{
$id1=$row["id"];
mysqli_query($link,"delete from main_menu where id=$id1");
delete_menu_records($id1);
}
}
?>

<script type="text/javascript">
window.location="index2.php";

</script>
</body>
</html>
