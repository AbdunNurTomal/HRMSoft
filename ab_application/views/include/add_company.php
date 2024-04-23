<?php
header('Content-Type: text/json');

	$fl_name=$_POST['e_fname'];
	$log_name=$_POST['e_lname'];
	$join_date=$_POST['e_jdate'];
	$email=$_POST['e_mail'];
	$phone=$_POST['e_phone'];
	$pass=$_POST['e_pass'];
	
	$row=mysql_query("INSERT INTO user (`m_id`, `name`, `e_mail`, `log_name`, `pass`, `u_type`, `status`, `join_date`, `phone`) VALUES ('', '$fl_name', '$email', '$log_name', '$pass', '3', 'Active', '$join_date', '$phone');");
if($row){
	$id = mysql_insert_id();
    $retVal = array(
        'status' => 'success',
        'sr' => array(
			'id' => $id,
            'e_fname' => $_POST['e_fname'],
			'e_lname' => $_POST['e_lname'],
			'e_jdate' => $_POST['e_jdate'],
			'e_mail' => $_POST['e_mail'],
			'e_phone' => $_POST['e_phone'],
			'e_pass' => $_POST['e_pass'],
			'e_status' => 'Active'
        )
    );
} else {
    $retVal = array(
        'status' => 'error'
    );
}

echo json_encode($retVal);
