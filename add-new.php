<?php
$servername = "localhost";
$username = "root";
$password = "";
$database= "mysql";
$conn= mysqli_connect($servername,$username,$password,$database);
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. "
        . mysqli_error($conn));
}


if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];
   $gender = $_POST['gender'];
   $mobile_no=$_POST['mobile_no'];

   $sql = "INSERT INTO `teachers`(`id`, `first_name`, `last_name`, `email`, `gender`,`mobile_no`) VALUES (NULL,'$first_name','$last_name','$email','$gender','$mobile_no')";
   $result = mysqli_query($conn,$sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">



   <script>
      function validateForm() {
         var firstName = document.forms["addStaffForm"]["first_name"].value;
         var lastName = document.forms["addStaffForm"]["last_name"].value;
         var email = document.forms["addStaffForm"]["email"].value;
         var mobileNo = document.forms["addStaffForm"]["mobile_no"].value;

         // Validate First Name
         if (firstName == "") {
            alert("First Name must be filled out");
            return false;
         }

         // Validate Last Name
         if (lastName == "") {
            alert("Last Name must be filled out");
            return false;
         }

         if (!/^[A-Za-z]+$/.test(firstName)) {
            alert("First Name must contain only alphabetical characters");
            return false;
         }

         // Validate Last Name
         if (!/^[A-Za-z]+$/.test(lastName)) {
            alert("Last Name must contain only alphabetical characters");
            return false;
         }

         // Validate Email
         var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
         if (!email.match(emailRegex)) {
            alert("Please enter a valid email address");
            return false;
         }

         // Validate Mobile Number
         var mobileRegex = /^[0-9]{10}$/;
         if (!mobileNo.match(mobileRegex)) {
            alert("Please enter a valid 10-digit mobile number");
            return false;
         }

         return true;
      }
   </script>


   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Teacher CRUD Operations</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      JKC Staff Member's Information
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Staff</h3>
         <p class="text-muted">Complete the form below to add a new staff</p>
      </div>

      <div class="container d-flex justify-content-center">
      <form name="addStaffForm" action="" method="post" onsubmit="return validateForm()" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">First Name:</label>
                  <input type="text" class="form-control" name="first_name" placeholder="Name" maxlength="15">
               </div>

               <div class="col">
                  <label class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Surname" maxlength="15">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Email:</label>
               <input type="email" class="form-control" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
          <label class="form-label">Mobile No:</label>
          <input type="text" class="form-control" name="mobile_no" value="" maxlength='10' placeholder="10 Digits Number">
        </div>


            <div class="form-group mb-3">
               <label>Gender:</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="male" value="male" required="">
               <label for="male" class="form-input-label">Male</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="female" value="female" required="">
               <label for="female" class="form-input-label">Female</label>
            </div>

            <div>
         <button type="submit" class="btn btn-success" name="submit">Save</button>
         <a href="index.php" class="btn btn-danger">Cancel</a>
      </div>
   </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>