<?php
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	
    $conn = mysqli_connect("localhost", "emil.stoyanov", "emosoto2003", "belot");

	$year = "";
	$month = "";
	$day = "";
	if (isset($_POST["year"]) && isset($_POST["month"]) && isset($_POST["day"])) {
		// Collect value of input field
		$year = $_POST["year"];
		$month = $_POST["month"];
		$day = $_POST["day"];
	}
	$thisYear = date("Y");
	$thisMonth = date("m");
	$thisDay = date("d");
	
	settype($year, 'integer');
	settype($month, 'integer');
	settype($day, 'integer');
	settype($thisYear, 'integer');
	settype($thisMonth, 'integer');
	settype($thisDay, 'integer');

	$yearcalc = $thisYear-$year;
	$monthcalc = $thisMonth-$month;
	$daycalc = $thisDay-$day;

	$usernameForTB = "";
	$passwordForTB = "";
	$emailForTB = "";
	$passwordForPasswordCheck ="";
	$nameForTB = "";
	$familyForTB = "";
	if (isset($_POST["usernameInsert"]) && isset($_POST["passwordInsert"])) {
		// Collect value of input field
		$usernameForTB = $_POST["usernameInsert"];
		$passwordForTB = $_POST["passwordInsert"];
		$emailForTB = $_POST["email"];
		$passwordForPasswordCheck = $_POST["passwordCheck"];
		$nameForTB = $_POST["name"];
		$familyForTB = $_POST["family"];
	}

	$sqlSelect = "SELECT `id`, `username`, `password`, `e-mail`, `name`, `family`, `reg_date` FROM `registratedusers`";

	// Cheking the table for same values
	$ChechkInTheTbaleUsername = true;
    $ChechkInTheTbaleEmail = true;

	if (isset($_POST["submit"])) {
		// Cheking the table for same values
		$result1 = $conn -> query($sqlSelect);
		while($row = $result1->fetch_assoc()){
			if ($usernameForTB != $row["username"]){
				$ChechkInTheTbaleUsername = true;
				continue;
			}
			else {
				$ChechkInTheTbaleUsername = false;
				break;
			}
		}
		while($row2 = $result2->fetch_assoc()){
			if ($emailForTB != $row2["e-mail"]){
				$ChechkInTheTbaleEmail = true;
				continue;
			}
			else {
				$ChechkInTheTbaleEmail = false;
				break;
			}
		}
	}
	
	//Red error paragraphs
	if (isset($_POST["submit"])){
		if($_POST['email'] == ""){
			echo "
				<script>
					document.getElementById('p1').innerHTML=\"*Въведете e-mail\";
				</script>
			";          
		}
		if ($ChechkInTheTbaleEmail == false && $_POST['email'] != ""){
			echo "
				<script>
					document.getElementById('p1').innerHTML=\"*Този e-mail е зает\";
				</script>
			";
		}
		if ($_POST['usernameInsert'] == "") {
			echo "
				<script>
					document.getElementById('p2').innerHTML=\"*Въведете потребителско име\";
				</script>
			";
		}
		if ($ChechkInTheTbaleUsername == false && $_POST['usernameInsert'] != "") {
			echo "
				<script>
					document.getElementById('p2').innerHTML=\"*Потребителското име е заето\";
				</script>
			";
		}
		if(strlen($_POST['passwordInsert']) < 8){
			echo "
			<script>
				document.getElementById('p3').innerHTML=\"*Въведете парола с поне 8 символа\";
				document.getElementById('p3').style.color=\"rgb(220, 0, 0)\";
			</script>
			";   
		}
		if($passwordForTB != $passwordForPasswordCheck){
			echo "
			<script>
				document.getElementById('p4').innerHTML=\"*Повторете паролата правилно\";
			</script>
			";   
		}
		if($_POST['passwordCheck'] == ""){
			echo "
			<script>
				document.getElementById('p4').innerHTML=\"*Повторете паролата\";
			</script>
			";            
		}
		if($_POST['name'] == ""){
			echo "
			<script>
				document.getElementById('p5').innerHTML=\"*Въведете име\";
			</script>
			";   
		}
		if($_POST['family'] == ""){
			echo "
			<script>
				document.getElementById('p6').innerHTML=\"*Въведете фамилия\";
			</script>
			";   
		}
		if($_POST['rememberMe'] == ""){
			echo "
			<script>
				document.getElementById('p8').innerHTML=\"*\";
			</script>
			";
		}
	}
?>