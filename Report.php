<?php
session_start();
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// Start output buffering
ob_start();

generateReport();

$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('student_report.pdf', array('Attachment' => 0));

if (!isset($_SESSION['fname'])) {
    header("Location: form.html");
    exit();
}

function generateReport()
{
    $cdate = $_SESSION['cdate'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $mname = $_SESSION['mname'];
    $mother = $_SESSION['mother'];
    $gender = $_SESSION['gender'];
    $age = $_SESSION['age'];
    $adress = $_SESSION['adress'];
    $email = $_SESSION['email'];
    $pno = $_SESSION['pno'];
    $mno = $_SESSION['mno'];
    $dob = $_SESSION['dob'];
    $mstatus = $_SESSION['mstatus'];
    $poccupation = $_SESSION['poccupation'];
    $states = $_SESSION['states'];
    $nationality = $_SESSION['nationality'];
    $district = $_SESSION['district'];
    $stream = $_SESSION['stream'];
    $ayear = $_SESSION['ayear'];
    $cast = $_SESSION['cast'];
    $addhar = $_SESSION['addhar'];
    $prevcollege = $_SESSION['prevcollege'];
    $preuni = $_SESSION['preuni'];
    $percent = $_SESSION['percent'];
    $seatno = $_SESSION['seatno'];

echo '<style>
.ll{
    border:none;
}
td{
    text-align:center;    
    border:1px solid black;
    font-weight:normal;
    padding :5px;
    height:20px;
    width:150px;
}
table{
    font-size: 14px;
    padding:0px;
    width:100%;
    height:10%;
    margin-top:15px;

 }
.bd{
    border:none;
    font-weight:bold;
    width:150px;
}
.row1{

    width:auto;
    padding-left: 535px;
}
.row2{
    width:100%;
}
.c1{
    width: 100%; 
    margin-top :none;     
}
.c2{
    width:auto;
}
.i{
    padding-top:10px;
    justify-content: center;
}
.photo{
    border: 2px solid black;
    width:130px;
    height: 120px;
    text-align:center;
    padding-top:35px;
    color:grey;
}
.full{
    padding :15px;
}
th{
    height: 50px;
    border: none;
    border-right: 1px solid black;
    border-bottom:1px solid black;
}
.t2{
    height:30px;
    border: none;
    border-right:1px solid black;
}
.l{
    border-right:none;
}
.h{
    margin: 95px;
    font-size :20;
    font-weight: bold;
}
.fr{
    margin-left:45px;
}  
.s{
    margin-left:45px;
    padding-left :45px;
}
img{
    height: 100px;
    width: 100px;
}

</style>';

echo "<body>";
// echo "<img src='jkclogo.jpg' style='text-align: center; width: 10%; height: auto;'>";

echo "<div class='full'>";
 echo "<div class='row1'> <div class='c2'> <div class='photo'>Photo</div> </div> </div> <div class='row2'> <div class='c1'> <center> <h4><u>Bharat Shikshan Prasarak Mandal Pune</h4><h3>Jaikranti College of Computer Science and <br>Management Studies, Pune</h3><h4>(Recognized by the Government of Maharashtra and Affiliated to Savitribai Phule Pune University)</u></h4> </center> </div> </div>"; echo "<hr style='border:1px solid black;'>"; if (isset($_SESSION['register_no'])) { $register_no = $_SESSION['register_no']; echo "<b style='margin-left :45px;'>Form No :</b> " . $register_no; echo "<span class='h'>Student Report</span>"; echo "<b>Date : </b>".$cdate; } echo "<br><div class='fr'> <p>The Principle,</p> <p><b>Jaikranti College Of Computer Science & Management Studies, Pune.</b></p> <p>Respected Sir,</p> <p>My Details are as follows : </p> </div>"; echo "<center>"; echo '<table background=" ">'; echo "<br>"; echo "<tr><td class='bd'>First Name : </td><td>".$fname."</td>"; echo "<td class='bd'>Last Name : </td><td>".$lname."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>Middele Name : </td><td>".$mname."</td>"; echo "<td class='bd'>Mother Name : </td><td>".$mother."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>Age : </td><td>".$age."</td>"; echo "<td class='bd'>Date Of Birth : </td><td>".$dob."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>Gender : </td><td>".$gender."</td>"; echo "<td class='bd'>Marital Status : </td><td>".$mstatus."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>Addhar no. : </td><td>".$addhar."</td>"; echo "<td class='bd'>Cast Category : </td><td>".$cast."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>Email-Id : </td><td>".$email."</td>"; echo "<td class='bd'>Address : </td><td>".$adress."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>Nationality : </td><td>".$nationality."</td>"; echo "<td class='bd'>District : </td><td>".$district."</td></tr>"; echo "<br>"; echo "<tr><td class='bd'>State : </td><td>".$states."</td>"; echo "<td class='bd'>Parents Occupation : </td><td>".$poccupation."</td></tr>"; echo "<br><br>"; echo "<tr><td class='bd'>Parent no. : </td><td>".$pno."</td>"; echo "<td class='bd'>Mobile no. : </td><td>".$mno."</td></tr>"; echo "<br><br>"; echo "<tr><td class='bd'>Stream : </td><td>".$stream."</td>"; echo "<td class='bd'>Year : </td><td>".$ayear."</td></tr>"; echo "</table></div>"; echo "<div class='full'>"; echo "<span class='fr'><b>Previous Exam Details</b></span> <table border='2px solid black'>"; echo "<tr> <th>Previous <br>University</th> <th>Previous <br>College</th> <th>Seat No.</th> <th class='l'>Percentage</th> </tr> <tr> <td class='t2'>".$preuni."</td> <td class='t2'>".$prevcollege."</td> <td class='t2'>".$seatno."</td> <td class='ll'>".$percent."</td> </tr> "; echo "</table>";
    echo "</center>";
    echo "<br><br><span class='fr'><b>I hereby declare the above filled form is correct, if any mistakes are found, it will be my whole & sole responsibility...</b></span><br><br>";
    echo "<br><br><br><br><span ><b>Student's Signature</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<span class='fr'><b>Parent's Signature</b></span>&nbsp;&nbsp;&nbsp;&nbsp;";
    
    echo "</div>";
echo"</body>";
}
?>