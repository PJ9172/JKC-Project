<?php
session_start(); // Start the session

require_once 'dompdf/autoload.inc.php'; // Include Dompdf library

use Dompdf\Dompdf;
use Dompdf\Options;

$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";
$con = mysqli_connect($servername, $username, $password, $database);

if (isset($_POST['submit'])) {
    $stream = $_POST['stream'];
    $cast = $_POST['cast'];
    $ayear = $_POST['ayear'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    if (!$con) {
        die("ERROR: Could not connect. " . mysqli_error($con));
    }

    $sql = "SELECT COUNT(*) AS admission_count FROM student
        WHERE cdate BETWEEN '$from_date' AND '$to_date'
        AND stream ='$stream' AND cast ='$cast' AND ayear = '$ayear'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $admission_count = $row['admission_count'];

    $sql = "select register_no, fname, lname, gender, mno, email, cdate from student where cast='$cast' and stream='$stream' and ayear='$ayear'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['pdf_data'] = array(); // Store PDF data in a session array

            ob_start(); // Start output buffering

            echo "<style>
                body{
                    background: linear-gradient(to bottom right, #66ffff 0%, #ff99cc 100%);

                }
                table{
                    background-color: white;
                    width:100%;
                    border:2px solid black;
                }
                .row{
                    display:flex;
                    flex-direction:row;
                    justify-content:space-around;
                    margin-top:50px;
                }
                .row button{
                    width:120px;
                    height:40px;
                    font-weight:700;
                    font-size:16px;
                    border-radius: 10px;
                    background-color: red;
                    color:white;
                    border:none;
                }
                .row button:hover{
                    background-color: white;
                    color:red;
                    border:2px solid red;
                    transition: 0.5s;
                }
            </style>";
            echo "<body>";
            echo "<center>";
            echo "<h1 style='margin-top: 50px;'>Student Information</h1>";
            echo "
            <table border='1px solid black' width='100%' style='margin-top: 30px; text-align:center ;'>
                <tr>
                    <th>Student Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Mobile No.</th>
                    <th>Email-Id</th>
                    <th>Admission Date</th>
                </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["register_no"] . "</td>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["lname"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["mno"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["cdate"] . "</td>";
                echo "</tr>";
                // Store data in the session array
                $_SESSION['pdf_data'][] = $row;
            }

            echo "</table>";
            echo "</center>";

            // Store additional data in the session
            $_SESSION['pdf_additional_data'] = array(
                'stream' => $stream,
                'cast' => $cast,
                'from_date' => $from_date,
                'to_date' => $to_date
            );
        } else {
            echo "<br><br>No students found with this stream and cast.";
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<body>
    <br>
    <!-- <h2>Admission Count</h2> -->
    <?php if (isset($admission_count)) : ?>
        <b>Admission Count<b><br>
        <p>Total number of students of the given faculty admitted from <?php echo $from_date; ?> to <?php echo $to_date; ?> in the <?php echo $stream; ?> stream with <?php echo $cast; ?> cast: <?php echo $admission_count; ?></p>
    <?php endif; ?>

    <div class="row">
        <a href="index.php"><button>Go Back</button></a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=mysql&table=student"><button>TO UPDATE</button></a>
        <!-- Add a button to generate and download the PDF -->
        <form method="post" action="generate_pdf.php" target="_blank">
        <button class="btn btn-success" name="generate_pdf">For PDF</button></form>
    </div>

        <!-- </form>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form> -->
</body>
</html>

<?php
if (isset($_POST['generate_pdf'])) {
    // Retrieve stored data from the session
    $pdf_data = $_SESSION['pdf_data'];
    $pdf_additional_data = $_SESSION['pdf_additional_data'];

    // Create a DOMPDF instance
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    ob_start(); // Start output buffering

    echo "<style>
        body{
            background-color: white;
        }
        table{
            background-color: white;
            width:100%;
            border:2px solid black;
        }
    </style>";
    echo "<body>";
    echo "<center>";
    echo "<h1 style='margin-top: 50px;'>Student Information</h1>";
    echo "
    <table border='1px solid black' width='100%' height='30%' style='margin-top: 30px; text-align:center ;'>
        <tr>
            <th>Student Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Mobile No.</th>
            <th>Email-Id</th>
            <th>Admission Date</th>
        </tr>";

    foreach ($pdf_data as $row) {
        echo "<tr>";
        echo "<td>" . $row["register_no"] . "</td>";
        echo "<td>" . $row["fname"] . "</td>";
        echo "<td>" . $row["lname"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["mno"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["cdate"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";

    // Get the HTML output
    $html = ob_get_clean();

    // Load HTML content
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Provide a link to download the PDF
    $pdfFileName = "student_details.pdf";
    file_put_contents($pdfFileName, $dompdf->output());
    echo "<a href='$pdfFileName' download>Click Me To Download PDF</a>";
}
?>


