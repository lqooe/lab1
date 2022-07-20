<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
    <tr><td>МАШИНА</td><td>ДОСТУПНОСТЬ НА ВЫБРАННУЮ ДАТУ</td></tr>
        <?php
        include('connection.php');
        if(isset($_GET["selected_date"]))
        {

            $selected_date = $_GET["selected_date"];
            $allCost=0;
            $result="";

            try{
                $res = $dbh->query("SELECT * FROM iteh2lb1var7.cars");
		            
                foreach($res as $row) {

                    $arrayCar[$row["ID_Cars"]]=$row["Name"];
                    $availableCar[$row["ID_Cars"]] = "YES";
                }


                $sql_get_rent = $dbh->query("SELECT * FROM iteh2lb1var7.rent");
               
                foreach($sql_get_rent as $row){

                    if (($row['Date_start'] <= $selected_date)){ 
                      if (($row['Date_end'] >= $selected_date)){
                        
                        if ($selected_date != $row['Date_start']){
                        
                          $availableCar[$row["FID_Car"]] = "NOT";
                        }

                  }
                }

                }
                foreach($availableCar as $id => $status) {
				
                  $result .= "<tr><td>".$arrayCar[$id]."</td><td>".$availableCar[$id]."</td></tr>";
                 
                }
                 echo $result;
            }
            catch(PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        ?>
    </table>
</body>
</html>