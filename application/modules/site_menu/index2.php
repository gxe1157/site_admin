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
<a href="add_menu_items.php?id=0">ADD MAIN MENU</a><br><br>
<?php
$res=mysqli_query($link,"select * from main_menu where parentid=0  order by parentid ");


echo "<div style='float: left;  min-width: 100px; color: #fff; background-color: #333;  border: 5px red solid;'>";

while($row=mysqli_fetch_array($res))
{
echo "<div style='min-width: 150px; padding: 0px 0px 0px 5px; border: 0px green solid;'>";
echo $row["title"]."<div style='float: right; width: 50px; background-color: orange'><a href='add_menu_items.php?id=$row[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>+</a><a href='delete_menu_items.php?id=$row[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>x</a></div>"."<br>";
echo "</div>";

 $id=$row["id"];
 $cou=0;
 $res5=mysqli_query($link,"select * from main_menu where parentid=$id");
 $cou=mysqli_num_rows($res5);
 
 if($cou>0){
	 echo "<div style='display: inline-block; color: #000; padding: 0px 0px 0px 0px; background-color: pink; width: 100%; border: 0px #000 solid;'>";
	 generate_menu($id,1);
	 echo "</div>";
 }

}

echo "</div>";



function generate_menu($id,$level)
{
   include "connection.php";
   $level++;
   $res1=mysqli_query($link,"select * from main_menu where parentid=$id");
   while($row1=mysqli_fetch_array($res1))
   {
     for($i=1;$i<=$level;$i++)
	 {
		if( $i>1) echo "<div style='float: left'>|---- </div>";
	 }
     echo "<div style='float: left; width: 150px; background-color: #ccc'>".$row1["title"]."</div><div style='float: right; width: 50px; background-color: green;'><a href='add_menu_items.php?id=$row1[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>+</a> <a href='delete_menu_items.php?id=$row1[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>x</a></div>"."<br>";  
	 $id1=$row1["id"];
     generate_menu($id1,$level);   
   }

}

?>







</body>
</html>
