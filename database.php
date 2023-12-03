<?php
        session_start(); // Start the session
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database= "mysql";
        $con = mysqli_connect($servername,$username,$password,$database);
         
        // Check connection
        if(!$con){
            die("ERROR: Could not connect. "
                . mysqli_error($con));
        }
         if(isset($_POST['submit']))
         {
        $fname =  strtoupper($_POST['fname']);
        $lname = strtoupper($_POST['lname']);
        
        $mname = strtoupper($_POST['mname']);
        $mother = strtoupper($_POST['mother']);
        $gender = $_POST['gender'];
        $age= strtoupper($_POST['age']);
        $adress = strtoupper($_POST['adress']);
        $email = $_POST['email'];
        $pno = strtoupper($_POST['pno']);
        $mno = strtoupper($_POST['mno']);
        $dob = strtoupper($_POST['dob']);
        $mstatus = strtoupper($_POST['mstatus']);
        $poccupation =strtoupper($_POST['poccupation']);
        $states = strtoupper($_POST['states']);
        $nationality =strtoupper($_POST['nationality']);
        $district = strtoupper($_POST['district']);
        $stream = strtoupper($_POST['stream']);
        $ayear = strtoupper($_POST['ayear']);
        $cast = strtoupper($_POST['cast']);
        $addhar = strtoupper($_POST['addhar']);
        $prevcollege = strtoupper($_POST['prevcollege']);
        $preuni = strtoupper($_POST['preuni']);
        $percent = strtoupper($_POST['percent']);
        $seatno = strtoupper($_POST['seatno']);

        


        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Fetch current date from the database
           
            $cdate = date('Y-m-d'); // Current date in the format "YYYY-MM-DD"
        
            // Store current date in the session
           
            $_SESSION['cdate'] = $cdate;
        } catch (PDOException $e) {
            // Handle database connection errors here
            die("Database Connection Error: " . $e->getMessage());
        }






         // Store form data in session variables
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['mname'] = $mname;
    $_SESSION['mother'] = $mother;
    $_SESSION['gender'] = $gender;
    $_SESSION['age'] = $age;
    $_SESSION['adress'] = $adress;
    $_SESSION['email'] = $email;
    $_SESSION['pno'] = $pno;
    $_SESSION['mno'] = $mno;
    $_SESSION['dob'] = $dob;
    $_SESSION['mstatus'] = $mstatus;
    $_SESSION['poccupation'] = $poccupation;
    $_SESSION['states'] = $states;
    $_SESSION['nationality'] = $nationality;
    $_SESSION['district'] = $district;
    $_SESSION['stream'] = $stream;
    $_SESSION['ayear'] = $ayear;
    $_SESSION['cast'] = $cast;
    $_SESSION['addhar'] = $addhar;
    $_SESSION['prevcollege'] = $prevcollege;
    $_SESSION['preuni'] = $preuni;
    $_SESSION['percent'] = $percent;
    $_SESSION['seatno'] = $seatno;

       
        // Performing insert query execution
        // here our table name is student.
        $sql = "INSERT INTO student(fname,lname,gender,adress,email,mname,mother,age,pno,mno,dob,mstatus,poccupation,states,nationality,district,stream,ayear,cast,addhar,prevcollege,preuni,percent,cdate,seatno) VALUES ('$fname',
            '$lname','$gender','$adress','$email','$mname','$mother','$age','$pno','$mno','$dob','$mstatus','$poccupation','$states','$nationality',
            '$district','$stream','$ayear','$cast','$addhar','$prevcollege','$preuni','$percent',NOW(),' $seatno')";
         if(mysqli_query($con, $sql)){
        
            $register_no = mysqli_insert_id($con);

            $_SESSION['register_no']=$register_no;
             echo "Successfully inserted data into the database";
        // Redirect to the report.php page
        header("Location: Report.php");
        exit();
            
             
        } 
        else{

            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($con);
        }
    
    
    }




    // If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 
            $insert = $db->query("INSERT into images (image, created) VALUES ('$imgContent', NOW())"); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
    
        // Close connection
        mysqli_close($con);
    
        
        ?>