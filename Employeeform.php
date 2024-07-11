<?php
include("connection.php");
?>

<?php
if(isset($_POST['searchdata']))
{
    $search = $_POST['search'];

    $query = "SELECT * FROM empform WHERE id='$search' ";

    $data = mysqli_query($conn,$query);

    $result = mysqli_fetch_assoc($data);

   // $name = $result['emp_name'];
   // echo $name;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="#">
        <h1>Employee Management System</h1>
        <div class="form">
           
        <input type="text" class="field" name="search" placeholder="Search Employee By ID" value="<?php if (isset($_POST['searchdata'])) { echo $result['id']; } ?>">

        <input type="text" class="field" name="empname" placeholder="Employee Name" value="<?php if (isset($_POST['searchdata'])) { echo $result['emp_name']; } ?>">
            
            
        <input type="email" class="field" name="email" placeholder= "Email Address"   value ="<?php if(isset($_POST['searchdata'])){echo $result['emp_email']; }?>" >
           
            <select class="field" name="gender">
                <option value="Not Selected">Select Gender</option>
                <option value="Male" <?php if($result['emp_gender'] == 'Male') { echo "selected"; } ?>>Male</option>
                <option value="Female" <?php if($result['emp_gender'] == 'Female') { echo "selected"; } ?>>Female</option>
                <option value="other" <?php if($result['emp_gender'] == 'other') { echo "selected"; } ?>>Other</option>
            </select>
            
            <select class="field" name="department">
                <option value="Not Selected">Select Department</option>
                <option value="Sales" <?php if($result['emp_department'] == 'Sales') { echo "selected"; } ?>>Sales</option>
                <option value="Accounts" <?php if($result['emp_department'] == 'Accounts') { echo "selected"; } ?>>Accounts</option>
                <option value="HR" <?php if($result['emp_department'] == 'HR') { echo "selected"; } ?>>HR</option>
                <option value="IT" <?php if($result['emp_department'] == 'IT') { echo "selected"; } ?>>IT</option>
                <option value="Marketing" <?php if($result['emp_department'] == 'Marketing') { echo "selected"; } ?>>Marketing</option>
                <option value="Bussiness Development" <?php if($result['emp_department'] == 'Bussiness Development') { echo "selected"; } ?>>Bussiness Development</option>
            </select>
            

            <textarea placeholder="Address" name="address"><?php if(isset($_POST['searchdata'])){echo $result['emp_address']; }?></textarea>

            <input type="submit" value="Search" name="searchdata" class="btnSearch">
            
            <input type="submit" value="Save" name="save" class="btnSearch" style="background-color: darkviolet;">
           
            <input type="submit" value="Update" name="update" class="btnSearch " style="background-color: chartreuse;">
            
            <input type="submit" value="Delete" name="delete" class="btnSearch" style="background-color: red;">
            
            <input type="reset" value="Clear" name="" class="btnSearch" style="background-color: maroon;">
            
        </div>
    </form>
    </div>
</body>
</html>


<?php
if(isset($_POST['save'])){
    $empname = $_POST['empname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    $query = "INSERT INTO empform (emp_name,emp_email,emp_gender,emp_department,emp_address) VALUES ('$empname','$email','$gender','$department','$address')";

    $data = mysqli_query($conn,$query);

    if($data){
        echo "Data save into Database";
    }
    else{
        echo "failed to save data";
    }

}
?>

<?php
if(isset($_POST['delete'])){
    $emp_id = $_POST['search'];
    echo $emp_id;

    $query = "DELETE FROM empform WHERE id= '$emp_id' ";
    $data = mysqli_query($conn,$query);

    if($data){
        echo "Record deleted succesfully";
    }
    else{
        echo "failed to delete record";
    }

}
?>

<?php
if (isset($_POST['update'])) {
    $emp_id = $_POST['search'];
    $empname = $_POST['empname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    $query = "UPDATE empform SET emp_name = ?, emp_email = ?, emp_gender = ?, emp_department = ?, emp_address = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $empname, $email, $gender, $department, $address, $emp_id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Failed to update record";
    }

    $stmt->close();
}
?>



