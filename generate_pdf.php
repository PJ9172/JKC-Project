<?php
require_once 'dompdf/autoload.inc.php'; // Include Dompdf library

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

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

// Output the PDF for the user to download
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=$pdfFileName");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges: bytes");
@readfile($pdfFileName);
unlink($pdfFileName); // Delete the temporary PDF file after sending

?>
