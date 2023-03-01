<?php
//files
require_once 'adapter.php';
$adaptervar = new adapter();

// echo "<pre>";
//get id 
$link = $_GET['id'];

// first display all orders for test only
// $query = "SELECT * FROM `orders`";
// $result = $adaptervar->fetchAll($query);
// print_r($result);

//now display orders with selected id only
//i want customer number where saleserepemployeenumber == employeeid
$finalquery = "SELECT `customerNumber` FROM `customers` WHERE salesRepEmployeeNumber={$link}";
$finalresult = $adaptervar->fetchAll($finalquery);
// print_r($finalresult);
// print_r($finalresult[0]['customerNumber']);


//now loop through each in finalresult and  convert it into string
for($i=0;$i < sizeof($finalresult); $i++){
    $arr[$i] = $finalresult[$i]['customerNumber'];
}
// print_r($arr);
$idd = join(',',$arr); //array to string convert
// print_r($idd);

// GET DATA > order number-date, shipped date, comment, status
$query = "SELECT `orderNumber`, `orderDate`, `shippedDate`, `comments`, `status` FROM `orders` WHERE customerNumber IN ($idd)";
$matchedorders = $adaptervar->fetchAll($query);
// print_r($matchedorders);


$statusquery = "SELECT `status` FROM `orders` WHERE customerNumber = '$idd'";
$options = $adaptervar->fetchAll($statusquery);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="employee.css">
    <title>Data</title>
</head>
<body>
<form method="post">
<div class="divemployee">
    <div class="heademployee">
    
    <!-- FILTER BY STATUS -->
        <label>Filter by order status</label>
        <select name="orderstatus">
                <option value="">Select Please</option>
                <?php foreach ($options as $eachoption):?>
                <option><?php echo $eachoption['status']; ?></option>  
                <?php endforeach; ?>    
        </select>    
    </div>
    <div class="tableclass">
        <table border="1px" >
            <tr>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Shipped Date</th>
                <th>Comment</th>
                <th>Status</th>
            </tr>
            <?php foreach ($matchedorders as $eachitem):?>
                <tr>
                    <td><?php echo $eachitem['orderNumber'] ?></td>
                    <td><?php echo $eachitem['orderDate'] ?></td>
                    <td><?php echo $eachitem['shippedDate'] ?></td>
                    <td><?php echo $eachitem['comments'] ?></td>
                    <td><?php echo $eachitem['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</form>
</body>
</html>