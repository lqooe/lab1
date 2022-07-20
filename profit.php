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
    <tr><th>МАШИНА</th><th>ДОХОД</th></tr>
        <?php
        include('connection.php');
        if(isset($_GET["selected_date"]))
        {
            $selected_date = $_GET["selected_date"];
            try{
            
                $res = $dbh->query("SELECT * FROM iteh2lb1var7.rent");
		            $allCost=0;
                $result="";
                foreach($res as $row) 
                {
                  if (($row['Date_start'] <= $selected_date) && ($row['Date_end'] >= $selected_date)){
                    
                    $sql_get_Car = "SELECT * FROM iteh2lb1var7.cars WHERE ID_Cars= :".$row['FID_Car'];
                    $sth = $dbh->prepare($sql_get_Car);
                    $sth->execute((array(':'.$row['FID_Car'] => $row['FID_Car'])));
                    $cursor = $sth->fetchAll();

                  foreach($cursor as $row1)
                  {
                      
                      $profit_all = strtotime($row['Date_end']) - strtotime($row['Date_start']);
                      $profit_all = $profit_all + strtotime($row['Time_end'])- strtotime($row['Time_start']);
                      $profit_all = $profit_all*1.0;
                      $costPerSec = $row['Cost'] / $profit_all;

                      $profit_day =$costPerSec*60*60*24;

                      if ($selected_date==$row['Date_start'])
                      {
                        $profit_day = $profit_day - ( (strtotime($row['Time_start']) - strtotime("00:00:00")) * $costPerSec);
                      }
                      else if ($selected_date==$row['Date_end'])
                      {
                        $profit_day = $profit_day - (( 86400-strtotime($row['Time_end']) + strtotime("00:00:00")) * $costPerSec);
                        
                      }

                      $result = $result."<tr><td>".$row1['Name']."</td><td>"."$profit_day"."</td></tr>";
                      $allCost = $allCost + $profit_day;

                  }

                  }
                  
                }
                print $result ;
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