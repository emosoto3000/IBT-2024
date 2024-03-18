<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>БЕЛОТ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Belot_style.css">
    <link rel="icon" href="../siteimages_belot/cards.png">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<body>
    <p class="title"><img src="siteimages_belot/cards.png" class="cards_img">БЕЛОТ</p>
    <?php
        error_reporting(0);
        $conn = mysqli_connect("localhost", "emil.stoyanov", "emosoto2003", "belot");
        $id = $_COOKIE["id"];
        $sqlSelect = "SELECT `nie`, `vie` FROM `result` WHERE `id`='$id'";
        $result = $conn -> query($sqlSelect);
        $nie = "";
        $vie = "";
        while($row = $result->fetch_assoc()){
            $nie = $row["nie"];
            $vie = $row["vie"];
            break;
		}
        if(isset($_COOKIE["loged"])){
            echo'
            <div style="max-width: 1570px; height: auto; margin: auto;">
                <form method="post">
	                <input type="submit" name="exit" value="Излез" class="exit_btn"></input>
                </form>
                ';
            if(isset($_POST["exit"])){
                session_destroy();
                setcookie("loged", "", time()-3600, "/");
                setcookie("id", "", time()-3600, "/");
                echo "
		            <script>
		            function loadLogIn(){
			            window.location.assign('http://" . $_SERVER['HTTP_HOST'] . "/');
		            }
		            loadLogIn();
		            </script>
                ";
            }
            echo '
                <form method="post">
                    <p class="label_p" id="win" style="display: none;"><p>
                    <p class="label_p" id="nie_p" style="margin-top: -3px;">Ние: ' . $nie . '</p>
                    <input type="text" placeholder="Добави резултат" name="nie" class="text_field" autocomplete="off">
                    <p class="label_p" id="vie_p">Вие: ' . $vie . '</p>
                    <input type="text" placeholder="Добави резултат" name="vie" class="text_field" autocomplete="off">
                    <div class="submit_btn_containerL">
                        <input type="submit" value="Добави" name="add" class="submit_btn">
                    </div>
                    <div class="submit_btn_containerR">
                        <input type="submit" value="Рестартирай" name="restart" class="submit_btn">
                    </div>
                </form>
                <div class="current_calc_container">
                    <p class="label_p" id="current_calc" style="margin-top: 12.5px; padding-left: 5px;"></p>
                </div>
                <div style="margin-top: 10px;">
                    <div style="width: 50%">
                        <div class="calc_column1">
                            <div class="calc_btn" id="1" style="margin-left: 0" onclick="click1()">1</div>
                            <div class="calc_btn" id="2" style="margin-left: 0">2</div>
                            <div class="calc_btn" id="3" style="margin-left: 0">3</div>
                        </div>
                        <div class="calc_column2">
                            <div class="calc_btn" id="4">4</div>
                            <div class="calc_btn" id="5">5</div>
                            <div class="calc_btn" id="6">6</div>
                        </div>
                        <div class="calc_btn" id="0" style="margin-left: 0;">0</div>
                    </div>
                    <div class="calc_column3">
                        <div class="calc_btn" id="7">7</div>
                        <div class="calc_btn" id="8">8</div>
                        <div class="calc_btn" id="9">9</div>
                        <div class="calc_btn" id="result" onclick="result()">=</div>
                    </div>
                    <div class="calc_column4">
                        <div class="calc_btn" id="C">C</div>
                        <div class="calc_btn" id="plus">+</div>
                        <div class="calc_btn" id="minus">-</div>
                        <div class="calc_btn" id="X">X</div>
                    </div>
                </div>
            </div>
                <script>
                    $("#1").click(function(){
                        $("#current_calc").append("1");
                    });
                    $("#2").click(function(){
                        $("#current_calc").append("2");
                    });
                    $("#3").click(function(){
                        $("#current_calc").append("3");
                    });
                    $("#4").click(function(){
                        $("#current_calc").append("4");
                    });
                    $("#5").click(function(){
                        $("#current_calc").append("5");
                    });
                    $("#6").click(function(){
                        $("#current_calc").append("6");
                    });
                    $("#7").click(function(){
                        $("#current_calc").append("7");
                    });
                    $("#8").click(function(){
                        $("#current_calc").append("8");
                    });
                    $("#9").click(function(){
                        $("#current_calc").append("9");
                    });
                    $("#0").click(function(){
                        $("#current_calc").append("0");
                    });
                    $("#C").click(function(){
                        $("#current_calc").html("");
                    });
                    $("#plus").click(function(){
                        var myString = $("#current_calc").html();
                        var lastChar = myString.slice(myString.length - 1);
                        if(lastChar == "1" || lastChar == "2" || lastChar == "3" || lastChar == "4" || lastChar == "5" || lastChar == "6" || lastChar == "7" || lastChar == "8" || lastChar == "9" || lastChar == "0"){
                            $("#current_calc").append(" + ");
                        }
                        lastChar = myString.slice(myString.length - 3);
                        if(lastChar == " X "){
                            $("#current_calc").text($("#current_calc").text().replace(" X "," + "));
                        }
                        else if(lastChar == " - "){
                            $("#current_calc").text($("#current_calc").text().replace(" - "," + "));
                        }
                    });
                    $("#minus").click(function(){
                        var myString = $("#current_calc").html();
                        var lastChar = myString.slice(myString.length - 1);
                        if(lastChar == "1" || lastChar == "2" || lastChar == "3" || lastChar == "4" || lastChar == "5" || lastChar == "6" || lastChar == "7" || lastChar == "8" || lastChar == "9" || lastChar == "0"){
                            $("#current_calc").append(" - ");
                        }
                        lastChar = myString.slice(myString.length - 3);
                        if(lastChar == " + "){
                            $("#current_calc").text($("#current_calc").text().replace(" + "," - "));
                        }
                        else if(lastChar == " X "){
                            $("#current_calc").text($("#current_calc").text().replace(" X "," - "));
                        }
                    });
                    $("#X").click(function(){
                        var myString = $("#current_calc").html();
                        var lastChar = myString.slice(myString.length - 1);
                        if(lastChar == "1" || lastChar == "2" || lastChar == "3" || lastChar == "4" || lastChar == "5" || lastChar == "6" || lastChar == "7" || lastChar == "8" || lastChar == "9" || lastChar == "0"){
                            $("#current_calc").append(" X ");
                        }
                        lastChar = myString.slice(myString.length - 3);
                        if(lastChar == " + "){
                            $("#current_calc").text($("#current_calc").text().replace(" + "," X "));
                        }
                        else if(lastChar == " - "){
                            $("#current_calc").text($("#current_calc").text().replace(" - "," X "));
                        }
                    });
                    function result(){
                        var current_calc = document.getElementById("current_calc").innerHTML;
                        current_calc = current_calc.replaceAll(" X ", " * ");
                        document.getElementById("current_calc").innerHTML = eval(current_calc);
                    }
                </script>
            ';
            if($nie >= 151 || $vie >= 151){
                if($nie > $vie){
                    echo '
                        <script>
                            document.getElementById("win").style.display="block";
                            document.getElementById("win").style.marginTop="20px";
                            document.getElementById("nie_p").style.marginTop="0px";
                            document.getElementById("win").innerHTML="Ние победихме!";
                        </script>
                    ';
                }
                else{
                    echo '
                        <script>
                            document.getElementById("win").style.display="block";
                            document.getElementById("win").style.marginTop="20px";
                            document.getElementById("nie_p").style.marginTop="0px";
                            document.getElementById("win").innerHTML="Вие победихме!";
                        </script>
                    ';
                }
            }
            $nie += (int)$_POST["nie"];
            $vie += (int)$_POST["vie"];
            if(isset($_POST["add"]) && isset($_POST["nie"]) && isset($_POST["vie"])){
                $sqlUpdateAdd = "UPDATE `result` SET `nie` = '$nie', `vie` = '$vie' WHERE `id`='$id'";
			    $conn->query($sqlUpdateAdd);
			    echo "<meta http-equiv='refresh' content='0'>"; 
            }
            if(isset($_POST["restart"])){
                $sqlUpdateRestart = "UPDATE `result` SET `nie` = '0', `vie` = '0' WHERE `id`='$id'";
			    $conn->query($sqlUpdateRestart);
			    echo "<meta http-equiv='refresh' content='0'>"; 
            }
        }
        else {
            echo'
                <div style="max-width: 1570px; height: auto; margin: auto;">
                    <form method="post">
                        <input type="text" placeholder="Потребителско име" name="username" class="text_field_login" autocomplete="off">
                        <input type="password" placeholder="Парола" name="password" class="text_field_login" autocomplete="off">
                        <label class="container_checkbox" style="margin-top: 30px; padding-bottom: 16px;">
                            <input type="checkbox" name="rememberMe" class="checkbox"></input>
                            <p class="checkbox_p" id="p9">Запомни ме</p>
                            <span class="checkmark_checkbox"></span>
                        </label>
                        <div class="submit_btn_containerL" style="margin-top: -5px;">
                            <input type="submit" value="Влез" name="login" class="submit_btn_login">
                        </div>
                        <div class="submit_btn_containerR" style="margin-top: -60px;">
                            <input value="Регистрирай се" type="button" class="submit_btn_login" onclick="window.location.assign(\'http://' . $_SERVER["HTTP_HOST"] . '/signup\');">
                        </div>
                    </form>
                </div>
            ';
            $usernameForTB = "";
		    $passwordForTB = "";
		    if (isset($_POST["username"]) && isset($_POST["password"])) {
			    // Collect value of input field
			    $usernameForTB = $_POST["username"];
			    $passwordForTB = $_POST["password"];
		    }
		    $sqlSelect = "SELECT `id`, `username`, `password`, `reg_date` FROM `registratedusers`";
		    $result1 = $conn -> query($sqlSelect);
		    $result2 = $conn -> query($sqlSelect);
		    if(isset($_POST["login"])) {
			    $CheckInTheTableUsername = false;
			    $CheckInTheTablePassword = false;
			    // Cheking the table for same values
			    while($row1 = $result1->fetch_assoc()){
				    if ($usernameForTB == $row1["username"]){;
					    $CheckInTheTableUsername = true;
					    break;
				    }
				    else {
					    $CheckInTheTableUsername = false;
					    continue;
				    }
			    }
			    while($row2 = $result2->fetch_assoc()){
				    if($passwordForTB == $row2["username"]){
					    $CheckInTheTablePassword = true;
					    break;
				    }
				    else {
					    $CheckInTheTablePassword = false;
					    continue;
				    }
			    }
                $id = "";
			    //Insert the values if they are not used
			    if($CheckInTheTablePassword && $CheckInTheTableUsername && $_POST["username"] != "" && $_POST["password"] != ""){
                    $sqlSelectid = "SELECT `id`,`username`, `reg_date` FROM `registratedusers` WHERE `username` = '$usernameForTB'";
                    $resultid = $conn -> query($sqlSelectid);
                    while($rowid = $resultid->fetch_assoc()){
                        $id = $rowid["id"];
                        break;
			        }
				    session_start();
				    if (isset($_POST["rememberMe"])) {
					    setcookie("loged", "1", time() + (86400 * 30), "/");
				    }
				    else {
					    //die when the browser is closed
					    setcookie("loged", "1", "blank", "/");
				    }
			        setcookie("id", $id, time() + (86400 * 30), "/");
				    echo "
					    <script>
						    function loadLogIn(){
							    window.location.assign('http://" . $_SERVER['HTTP_HOST'] . "/');
						    }
						    loadLogIn();
					    </script>
				    ";
			    }
			    if($CheckInTheTableUsername == false){
				    echo "
					    <script>
						    document.getElementById('p1').innerHTML=\"*Сгрешено потребителско име\";
					    </script>
				    ";
			    }
			    if($CheckInTheTablePassword == false){
				    echo "
					    <script>
						    document.getElementById('p2').innerHTML=\"*Сгрешена парола\";
					    </script>
				    ";
			    }
			    if($_POST["username"] == ""){
				    echo "
					    <script>
						    document.getElementById('p1').innerHTML=\"*Въведете потребителско име\";
					    </script>
				    ";
			    }
			    if($_POST["password"] == ""){
				    echo "
					    <script>
						    document.getElementById('p2').innerHTML=\"*Въведете парола\";
					    </script>
				    ";
			    }
				
			    if($_POST["username"] == "" && $_POST["password"] == ""){
				    echo "
					    <script>
						    document.getElementById('p1').innerHTML=\"*Въведете потребителско име\";
						    document.getElementById('p2').innerHTML=\"*Въведете парола\";
					    </script>
				    ";
			    }
		    }
        }
    ?>
</body>
</html>