<?php
    error_reporting(E_ALL & ~E_WARNING);
	
    $conn = mysqli_connect("localhost", "emil.stoyanov", "emosoto2003", "belot");
        
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
		$result2 = $conn -> query($sqlSelect);
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
				$ChechkInTheTbaleEmail= false;
				break;
			}
		}
	}
    if(isset($_POST['email'])){
        if(isset($_POST['usernameInsert'])){
            if(isset($_POST['passwordInsert'])){
                if(isset($_POST['passwordCheck'])){
                    if(isset($_POST['name'])){
                        if(isset($_POST['family'])){
                            if(isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year'])){
                                if(isset($_POST['rememberMe'])){
                                    if($year <= 2001){
	                                    if (isset($_POST["submit"])) {
											if($passwordForTB == $passwordForPasswordCheck){
				                                //Insert the values if they are not used
												if($ChechkInTheTbaleUsername && $ChechkInTheTbaleEmail){
													$md5Username = md5($_POST['usernameInsert']);
													$sqlInsert = "INSERT INTO `registratedusers`(`id`, `username`, `password`, `e-mail`, `name`, `family`, `reg_date`) VALUES (NULL, '$usernameForTB', '$passwordForTB', '$emailForTB', '$nameForTB', '$familyForTB', current_timestamp())";
													if ($conn->query($sqlInsert) === TRUE) {}
													else {
														echo "Error: " . $sqlInsert . "<br>" . $conn->error;
													}
													$sqlSelectInserted = "SELECT `id` FROM `registratedusers` WHERE `username` = '$usernameForTB'";
													$resultIns = $conn -> query($sqlSelectInserted);
													$id = "";
													while($rowIns = $resultIns->fetch_assoc()){
														$id = $rowIns["id"];
													}
													$sqlInsertResult = "INSERT INTO `result`(`id`, `nie`, `vie`) VALUES ('$id', 0, 0)";
													if ($conn->query($sqlInsertResult) === TRUE) {
														echo "
															<script>
																function loadLogIn(){
																	window.location.assign('http://localhost/');
																}
																loadLogIn();
															</script>
														";
													}
				                                }
		                                    }
	                                    }
                                    }
                                    else if($year == 2002){
	                                    if($monthcalc > 0){
		                                    if (isset($_POST["submit"])) {
			                                    if($passwordForTB == $passwordForPasswordCheck){
				                                    //Insert the values if they are not used
													if($ChechkInTheTbaleUsername && $ChechkInTheTbaleEmail){
														$md5Username = md5($_POST['usernameInsert']);
														$sqlInsert = "INSERT INTO `registratedusers`(`id`, `username`, `password`, `e-mail`, `name`, `family`, `reg_date`) VALUES (NULL, '$usernameForTB', '$passwordForTB', '$emailForTB', '$nameForTB', '$familyForTB', current_timestamp())";
														if ($conn->query($sqlInsert) === TRUE) {}
														else {
															echo "Error: " . $sqlInsert . "<br>" . $conn->error;
														}
														$sqlSelectInserted = "SELECT `id` FROM `registratedusers` WHERE `username` = '$usernameForTB'";
														$resultIns = $conn -> query($sqlSelectInserted);
														$id = "";
														while($rowIns = $resultIns->fetch_assoc()){
															$id = $rowIns["id"];
														}
														$sqlInsertResult = "INSERT INTO `result`(`id`, `nie`, `vie`) VALUES ('$id', 0, 0)";
														if ($conn->query($sqlInsertResult) === TRUE) {
															echo "
																<script>
																	function loadLogIn(){
																		window.location.assign('http://localhost/');
																	}
																	loadLogIn();
																</script>
															";
														}
													}
			                                    }
		                                    }
	                                    }
	                                    else if($monthcalc == 0){
		                                    if($daycalc >= 0){
			                                    if (isset($_POST["submit"])) {
				                                    if($passwordForTB == $passwordForPasswordCheck){
														if($ChechkInTheTbaleUsername && $ChechkInTheTbaleEmail){
															$md5Username = md5($_POST['usernameInsert']);
															$sqlInsert = "INSERT INTO `registratedusers`(`id`, `username`, `password`, `e-mail`, `name`, `family`, `reg_date`) VALUES (NULL, '$usernameForTB', '$passwordForTB', '$emailForTB', '$nameForTB', '$familyForTB', current_timestamp())";
															if ($conn->query($sqlInsert) === TRUE) {}
															else {
																echo "Error: " . $sqlInsert . "<br>" . $conn->error;
															}
															$sqlSelectInserted = "SELECT `id` FROM `registratedusers` WHERE `username` = '$usernameForTB'";
															$resultIns = $conn -> query($sqlSelectInserted);
															$id = "";
															while($rowIns = $resultIns->fetch_assoc()){
																$id = $rowIns["id"];
															}
															$sqlInsertResult = "INSERT INTO `result`(`id`, `nie`, `vie`) VALUES ('$id', 0, 0)";
															if ($conn->query($sqlInsertResult) === TRUE) {
																echo "
																	<script>
																		function loadLogIn(){
																			window.location.assign('http://localhost/');
																		}
																		loadLogIn();
																	</script>
																";
															}
														}
                                                    }
			                                    }
		                                    }  
	                                    }
                                    }
								}
							}
                        }
                    }
                }
            }
        }
    }
?>