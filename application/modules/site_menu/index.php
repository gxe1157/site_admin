<?php
include "connection.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Multi-Level Drop Down Menu with Pure CSS</title>
    <style>
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #ed8a12;
        }

        ul li {
            display: block;
            position: relative;
            float: left;
            background: #ed8a12;
        }

        /* This hides the dropdowns */
        li ul {
            display: none;
        }

        ul li a {
            display: block;
            padding: 1em;
            text-decoration: none;
            white-space: nowrap;
            color: #fff;
        }

        ul li a:hover {
            background: #d57c10;
        }

        /* Display the dropdown */
        li:hover > ul {
            display: block;
            position: absolute;
        }

        .main-navigation li ul li {
            border-top: 0;
        }

        ul ul ul {
            left: 100%;
            top: 0;
        }

        ul:before,
        ul:after {
            content: " "; /* 1 */
            display: table; /* 2 */
        }

        ul:after {
            clear: both;
        }

        .downarrow {
            background-image: url(darrow.png);
            background-repeat: no-repeat;
            background-size: 15px;
            15px;
            background-position: right 25px;
        }

        .downarrow:hover {
            background-image: url(darrow.png);
            background-repeat: no-repeat;
            background-size: 15px;
            15px;
            background-position: right 25px;
        }

        .rightarrow {
            background-image: url(rarrow.png);
            background-repeat: no-repeat;
            background-size: 20px;
            20px;
            background-position: right;
        }

        .rightarrow:hover {
            background-image: url(rarrow.png);
            background-repeat: no-repeat;
            background-size: 20px;
            20px;
            background-position: right;
        }
    </style>
</head>

<body>
<ul class="main-navigation">

    <?php
    $res = mysqli_query($link, "select * from main_menu where parentid=0   order by id asc ");
    while ($row = mysqli_fetch_array($res)) {

        $id = $row["id"];

        $cou = 0;
        $res5 = mysqli_query($link, "select * from main_menu where parentid=$id");
        $cou = mysqli_num_rows($res5);

        if ($cou > 0) {
            echo "<li class='downarrow'>";
            echo "<a href='$row[link]' class='downarrow'>" . $row["title"] . "</a>";
        } else {
            echo "<li>";
            echo "<a href='$row[link]'>" . $row["title"] . "</a>";
        }
        if ($cou > 0) {
            generate_menu($id, 1);
        } else {
            echo "</li>";
        }

    }
    function generate_menu($id, $level)
    {
        include "connection.php";

        echo "<ul>";

        $level++;
        $res1 = mysqli_query($link, "select * from main_menu where parentid=$id");
        while ($row1 = mysqli_fetch_array($res1)) {

            $id1 = $row1["id"];

            $cou55 = 0;
            $res55 = mysqli_query($link, "select * from main_menu where parentid=$id1");
            $cou55 = mysqli_num_rows($res55);

            if ($cou55 > 0) {
                echo "<li class='rightarrow'>";
                echo "<a href='$row1[link]' class='rightarrow'>" . $row1["title"] . "</a>";
            } else {
                echo "<li>";
                echo "<a href='$row1[link]'>" . $row1["title"] . "</a>";
            }
            if ($cou55 > 0) {
                generate_menu($id1, $level);
            } else {
                echo "</li>";
            }

        }
        echo "</ul>";

    }

    ?>


</body>
</html>
