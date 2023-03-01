<?php
// echo "<pre>";
//get file
require_once 'adapter.php';

//get access to class and it's functions
$adaptervar = new adapter();

// //write query displays main db
$query = "SELECT *,offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode";
$employeedata = $adaptervar->fetchAll($query);

//query to show all the data all time in option values
$sql = "SELECT *,offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode";
$employ = $adaptervar->fetchAll($sql);

//get the selected value store in var
// print_r($_POST);
$fname = $_POST['firstname'];
$mail = $_POST['email'];
$reports = $_POST['reportsto'];
$cityy = $_POST['city'];

if($fname != null){
    $query = "SELECT *,offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE employees.firstName = '$fname'";
    $employeedata = $adaptervar->fetchAll($query);
}
else if($mail !=null){
    $query = "SELECT *,offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE employees.email = '$mail'";
    $employeedata = $adaptervar->fetchAll($query);    
}
else if($reports !=null){
    $query = "SELECT *,offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE employees.reportsTo = '$reports'";
    $employeedata = $adaptervar->fetchAll($query);    
}
else if($cityy !=null){
    $query = "SELECT *,offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE offices.city = '$cityy'";
    $employeedata = $adaptervar->fetchAll($query);  
}


// print_r($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="grid.css">
    <title>PHP Test</title>
</head>
<body>
<form method="post">
    <div class="maindiv">
        <!-- head -->
        <div class="headofgrid">
            <label>Filter by First name</label>
            <select name="firstname">
                <option value="">select please</option>
                <?php foreach($employ as $eachitem): ?>
                <option ><?php echo $eachitem['firstName'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Filter by email</label>
            <select name="email">
                <option value="">select please</option>
                <?php foreach($employ as $eachitem): ?>
                <option><?php echo $eachitem['email'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Filter by Reports to</label>
            <select name="reportsto">
                <option value="">select please</option>
                <?php foreach($employ as $eachitem): ?>
                <option><?php echo $eachitem['reportsTo'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Filter by City </label>
            <select name="city">
                <option value="">select please</option>
                <?php foreach($employ as $eachitem): ?>
                <option><?php echo $eachitem['city'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <input type="submit" />

        </div>
        <!-- table -->
        <table border="1px" class="table">
            <tr>
                <th>Employee No.</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Extension</th>
                <th>Email</th>
                <th>Office Code</th>
                <th>City</th>
                <th>Reports To</th>
                <th>Job title</th>
                <th>Action View</th>
            </tr>

            <?php
            foreach ($employeedata as $eachitem) {
            ?>
                <tr>
                    <td><?php echo $eachitem['employeeNumber'] ?></td>
                    <td><?php echo $eachitem['lastName'] ?></td>
                    <td><?php echo $eachitem['firstName'] ?></td>
                    <td><?php echo $eachitem['extension'] ?></td>
                    <td><?php echo $eachitem['email'] ?></td>
                    <td><?php echo $eachitem['officeCode'] ?></td>
                    <td><?php  echo $eachitem['city'] ?></td>
                    <td><?php echo $eachitem['reportsTo'] ?></td>
                    <td><?php echo $eachitem['jobTitle'] ?></td>
                    <td><a href="employee.php?id=<?php echo $eachitem['employeeNumber'] ?>">VIEW EMPLOYEE</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</form>
</body>
</html>