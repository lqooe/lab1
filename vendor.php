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
        <tr>
            <th>ID_Cars</th>
            <th>Name</th>
            <th>Release_date</th>
            <th>Race</th>
            <th>State(new,old)</th>
            <th>FID_Vendors</th>
            <th>Price</th>
        </tr>
        <?php
        include('connection.php');
        if(isset($_GET["vend"]))
        {
            $vend = $_GET["vend"];
           
            try{
              
              $sql_get_vend = "SELECT * FROM iteh2lb1var7.vendors";
              
              foreach($dbh->query($sql_get_vend) as $row)
              {
                if ($vend==$row['Name'])
                {
                  $idVendor=$row['ID_Vendors'];
                }
              }
              
                $sql_getId = "SELECT * FROM iteh2lb1var7.cars WHERE FID_Vendors= :".$idVendor;
                $sth = $dbh->prepare($sql_getId);
                $sth->execute((array(':'.$idVendor => $idVendor)));
                
                $cursor = $sth->fetchAll();
                 foreach($cursor as $row)
                {
                    $id_car = $row['ID_Cars'];
                    $name = $row['Name'];
                    $release = $row['Release_date'];
                    $race = $row['Race'];
                    $state = $row['State(new,old)'];
                    $fid_vendors = $row['FID_Vendors'];
                    $price = $row['Price'];

                    print "<tr> <th>$id_car</th> <th>$name</th>
                    <th>$release</th> <th>$race</th><th>$state</th>
                    <th>$fid_vendors</th><th>$price</th></tr>";

                }

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