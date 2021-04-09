<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
require 'fpdf182/html2pdf.php';
if (isset($_POST['submit'])) {
    handleDownload();
}

function handleDownload()
{

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];

    $hours = $_POST['hours_worked'];
    $salary = $_POST['salary'];
    $overtime = $_POST['overtime_worked'];
    $preTax = $_POST['pre_tax_income'];
    $postTax = $_POST['post_tax_income'];
    $deductables = $_POST['deductables'];
    $finalIncome = $_POST['final_income'];

    $date = $_POST['Date'];
    $location = $_POST['location'];

    $pdfHTML = <<<PAYSLIP
    

    
    <p>Payslip</p>
    <p>Name: $first $last</p>
    <p>email: $email</p>
    <p>Address: $address</p>
    <p>Postcode: $postcode</p>
    <p>Hours Worked: $hours</p>
    <p>Salary Total: $salary</p>
    <p>Overtime Worked: $overtime</p>
    <p>Pre Tax income: $preTax</p>
    <p>Post Tax income: $postTax</p>
    <p>Dedecutables: $deductables</p>
    <p>Final Income: $finalIncome</p>

    <p>Payslip date: $date - Location worked: $location</p>
    <img src="./img/Logo.png" width="300" >
PAYSLIP;

   

    $pdf=new PDF_HTML();
    $pdf->SetFont('Arial','',12);
    $pdf->AddPage();
    $pdf->WriteHTML($pdfHTML);
    $pdf->Output();

}
