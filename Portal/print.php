<?php
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  

	function generateRow($myPDO){
		$contents = '';
		
        $timesheet_id = filter_has_var(INPUT_GET, 'timesheetID') ? $_GET['timesheetID'] : null; 
        $process_id = filter_has_var(INPUT_GET, 'processID') ? $_GET['processID'] : null; 
        $payslip_id = filter_has_var(INPUT_GET, 'payslipID') ? $_GET['payslipID'] : null; 

        $query  = $myPDO->query("SELECT * 
        FROM hd_payslips
        INNER JOIN hd_staff_users on (hd_payslips.staff_id = hd_staff_users.staff_id)
        INNER JOIN hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id)
        INNER JOIN hd_payslip_process on (hd_payslips.process_id = hd_payslip_process.process_id)
		INNER JOIN hd_timesheet_responses on (hd_payslips.timesheet_id = hd_timesheet_responses.timesheet_id)
		WHERE hd_payslips.timesheet_id = '$timesheet_id'");
        
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){
			$contents .= "
            <tr>
            <td>".$row['Date']."</td>
            <td>".$row['staff_first_name']. " ".$row['staff_last_name']."</td>
            <td>".$row['hours_worked']."</td>
            <td>".$row['overtime_worked']."</td>
            <td>".$row['salary']."</td>

            <td>".$row['pre_tax_income']."</td>
            <td>".$row['post_tax_income']."</td>
            <td>".$row['deductables']."</td>
            <td>".$row['final_income']."</td>
			</tr>
			";
		}

		return $contents;
	}

	require_once('inc/tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Employee payslip');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">Employee Payslip</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th  align="center"><b>Date</b></th>
                <th  align="center"><b>Name</b></th>
                <th  align="center"><b>Hours</b></th>
                <th  align="center"><b>Overtime</b></th>
                <th  align="center"><b>Salary</b></th>

                <th  align="center"><b>Pre tax</b></th>
                <th  align="center"><b>Post tax</b></th>
                <th  align="center"><b>Deduction</b></th>

                <th  align="center"><b>Total Pay</b></th>
           </tr>  
      ';  
    $content .= generateRow($myPDO); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>