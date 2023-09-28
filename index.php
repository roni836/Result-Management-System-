<?php
$connect = mysqli_connect('localhost','root','','rms') or die("Db Fail to Connect");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <div class="logo"><h1>Result Management System</h1></div>
</div>

<div class="container">
    <div class="form">
<form action="index.php" method="post">
    <div class="mb-3">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter Your Name" class="control">
    </div>
    <div class="mb-3">
        <label for="father">Father Name</label>
        <input type="text" id="father" name="father" placeholder="Enter Your Father's Name" class="control">
    </div>
    <div class="mb-3">
        <label for="contact">Contact</label>
        <input type="tel" id="contact" name="contact" placeholder="Enter Your Contact NO." class="control">
    </div>
    <div class="mb-3">
        <label for="maths">Maths</label>
        <input type="number" id="maths" name="maths" placeholder="Maths Marks " class="control">
    </div>
    <div class="mb-3">
        <label for="sci">Science</label>
        <input type="number" id="sci" name="sci" placeholder="Science Marks" class="control">
    </div>
    <div class="mb-3">
        <label for="sst">SSt</label>
        <input type="number" id="sst" name="sst" placeholder="SSt Marks" class="control">
    </div>
    <div class="mb-3">
        <label for="eng">English</label>
        <input type="number" id="eng" name="eng" placeholder="English Marks" class="control">
    </div>
    <div class="mb-3">
        <label for="hindi">Hindi</label>
        <input type="number" id="hindi" name="hindi" placeholder="Hindi Marks" class="control">
    </div>
    <div>
    <input type="submit" name="create" value="Create Result Record" class="btn">
    <input type="reset" value="Reset Record" id="clear" class="btn">
    </div>
</form>

<?php
    if(isset($_POST['create'])){
        $name = $_POST['name'];
        $father = $_POST['father'];
        $contact = $_POST['contact'];
        $maths = $_POST['maths'];
        $sci = $_POST['sci'];
        $sst = $_POST['sst'];
        $eng = $_POST['eng'];
        $hindi = $_POST['hindi'];
}

    $query = "INSERT INTO students (name,father,contact,maths,sci,sst,eng,hindi) value('$name','$father','$contact','$maths','$sci','$sst','$eng','$hindi')";

    $run = mysqli_query($connect,$query);
    if($run){
        echo"<script>alert('Successfully Added')</script>";
        echo"<script>window.open('index.php')</script>";
}
    else{
        echo"<script> alert('Failed')</script>";
}
?>
</div>
    <div class="table">
<table>
    <thead>
        <tr>
            <th>Roll</th>
            <th>Name</th>
            <th>Father's Name</th>
            <th>Contact</th>
            <th>Maths</th>
            <th>Science</th>
            <th>SSt</th>
            <th>English</th>
            <th>Hindi</th>
            <th>Total Marks</th>
            <th>Percentage</th>
            <th>CGPA</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
        $query = "select * from students";
        $run = mysqli_query($connect,$query);
        while($row = mysqli_fetch_array($run)){
            $roll = $row['roll'];
            $name = $row['name'];
            $father = $row['father'];
            $contact = $row['contact'];
            $maths = $row['maths'];
            $sci = $row['sci'];
            $sst = $row['sst'];
            $eng = $row['eng'];
            $hindi = $row['hindi'];

            $total = $maths + $sci + $sst + $eng + $hindi;
            $percentage = $total * 100/500;
            $cgpa = number_format($percentage/9.5,2);
            $status = ($percentage >= 40) ? "Pass &#10004" : "Fail &#10060";
            $status_class = ($percentage >= 40) ? "pass" : "fail";

            echo"
                <tr>
                <td>$roll</td>
                <td>$name</td>
                <td>$father</td>
                <td>$contact</td>
                <td>$maths</td>
                <td>$sci</td>
                <td>$sst</td>
                <td>$eng</td>
                <td>$hindi</td>
                <td class='$status_class'>$total</td>
                <td class='$status_class'>$percentage%</td>
                <td class='$status_class'>$cgpa</td>
                <td class='$status_class'>$status</td>
                </tr>";
        }        
    ?>
    </tbody>
</table>
    </div>
    </div>
</body>
</html>