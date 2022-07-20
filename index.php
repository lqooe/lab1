<?php
 include('connection.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ЛБ1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<h2>Лабораторная работа №1</h2>

<div class="wrapper1">
    <form action="profit.php" method="get">
        <p><strong>Выберите дату чтоб узнать доход с проката</strong>

            <input name="selected_date" type=date>
            <input class="buttons"  type="submit" value="Узнать" />

    </form>


    <form method="get" action="vendor.php">
        <p><strong>Выберите производителя, для просмотра его машин</strong>

            <select name='vend'>
                <option>Производители</option>

                <?php
        $sql = "SELECT * FROM iteh2lb1var7.vendors";

        foreach($dbh->query($sql) as $row)
                {
                $name_vend = $row['Name'];
                echo "<option value = '$name_vend'> $name_vend</option>";
                }
                ?>
        </p>
        </select>

        <input class="buttons" type="submit" value="Посмотреть">
    </form>
    <form method="get" action="avaible_car.php">
        <p><strong>Выберите дату чтоб получить доступные авто</strong>

            <input name="selected_date" type=date >
            <input class="buttons" type="submit" value="Получить" />
        </p>
    </form>
</div>


<!-- Изменение данных -->

<div class="wrapper2">
    <h3> Аренда</h3>

    <form method="get" action="rent.php" id="form">
        <p><strong>Выберите дату:</strong>

            <a style="margin-left: 0px;">Начало:</a>
            <input type="date" name= "start_date"  >
            <input type="time" name = "start_time"><br>

            <a style="margin-left: 153px;">Конец:</a>
            <input type="date" name="end_date">
            <input type="time" name="end_time" ><br>
        </p>
        <h3></h3>
        <p><strong>Выберите авто:</strong>
            <select name='selected_car'>
                <option>Автомобиль</option>
                <?php
                        $sqlSelect = "SELECT * FROM iteh2lb1var7.cars";
                        foreach ($dbh->query($sqlSelect) as $cell) {
                $name_car = $cell['Name'];
                echo "<option value = '$name_car'> $name_car</option>";
                }
                ?>
            </select>
        </p>
        <h3></h3>
        <p><strong>Введите цену:</strong>
            <input name="rental_price"  type="text" value="0" />
        </p>
        <h3></h3>
        <input class="buttons" type="submit" value="Арендовать" />
    </form>

        
</div>
<div class="wrapper3">
    <h3> Изменение пробега</h3>
    <form method="get" action="race_change.php" id="form">
        <p><strong>Выберите авто:</strong>
            <select name='carr'>
                <option>Автомобиль</option>
                <?php
                    $sqlSelect = "SELECT * FROM iteh2lb1var7.cars";
                    foreach ($dbh->query($sqlSelect) as $cell) {
                $name_car = $cell['Name'];
                
                echo "<option value = '$name_car'> $name_car</option>"; 
                }
                ?>
            </select>
        </p>
        <h3></h3>
        <p><strong>Введите пробег:</strong>
            <input name="racee"  type="text" value="0" />
        </p>
        <input class="buttons"   type="submit" value="Изменить" />   
    </form>
</div>

</body>

</html>