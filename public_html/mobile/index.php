<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>TrenerPJM</title>
    <link rel="stylesheet" type="text/css" href="menu.css">
    <link href='http://fonts.googleapis.com/css?family=Basic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>



<div id="formBox">

    <div id="titleBox">
        <p id="title"> Wybierz zestaw słówek</p>
    </div>


    <form action="training.php" method="post">

        <fieldset>

            <select name="directorypath" <!--multiple--> >
                <?php

                $directorypath = "../lists/";
                $lists = array();
                exec("ls $directorypath", $lists);

                foreach ($lists as $list) {
                    echo "<option value=\"";
                    echo $directorypath . $list;
                    echo "\"  class=\"formOption\" >";
                    echo $list;
                    echo "</option>";
                }

                ?>

                <!-- <option value="./films//"></option> -->
            </select>

        </fieldset>

        <input type="submit" name="submit" value="Start" />

    </form>


</div>





</body>
</html>