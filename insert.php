<?php
$Email = $_POST['Email'];
$Patientname = $_POST['Patientname'];
$Psw = $_POST['Psw'];
$Cpsw = $_POST['Cpsw'];

if (!empty($Email)|| !empty($Patientname) || !empty($Psw)){	
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "doctor";
	//create connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


	if(mysqli_connect_error()){
		die('Connect Error('. mysqli_connect_error().')'.mysqli_connect_error());
	}else{
		$SELECT = "SELECT Email From patient Where Email = ? limit 1";
		$INSERT = "INSERT Into patient(Email, Patientname, Psw) values(?, ?, ?)";
		//prepare statement
		$stmt = $conn->prepare($SELECT);
		$stmt ->bind_param("s", $Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;

		if  ($rnum==0) {
			$stmt->close();
			$stmt = $conn->prepare("INSERT INTO patient(Email, Patientname, Psw)values(?, ?, ?)");
			$stmt->bind_param("sss", $Patientname, $Email, $Psw);
			$stmt->execute();
			echo "Account Successfully Added";

		} else {
			echo"Account Already Exists";
		}
		if ($_POST["Psw"] === $_POST["Cpsw"]) {
			header("location:log.html");
			exit;
			 }
			 else {
			echo "<br>the password do not match";
			 }
//		$stmt->close();
	//	$conn->close();
 	}
	 

}
	
 
?>
