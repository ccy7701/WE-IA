<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Registration | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <style>
        .regMatric, .regPassword {
            height: 30px;
            width: 100%;
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            font-family: Jost, monospace;
        }
    </style>
</head>

<body>
    <script type="text/javascript">
        function checkMatric(matric) {
            let passFlag = 1;
            let errorMessage = "";
            
            // check: matric number follows constraint
            var pattern = /^BI\d{8}$/;
            if (!pattern.test(matric)) {
                passFlag = 0;
                let error = "ERROR: Matric number does not follow required format.\n";
                errorMessage = errorMessage.concat(error);
            }
            
            return [passFlag, errorMessage];
        }

        function checkPassword(password) {
                let passFlag = 1;
                let errorMessage = "";

                // check: password length is 8 or more
                if (password.length < 8) {
                    passFlag = 0;
                    let error = "ERROR: Password is shorter than minimum required length.\n";
                    errorMessage = errorMessage.concat(error);
                }

                // check: password contains at least one capital letter
                if (!/[A-Z]/.test(password)) {
                    passFlag = 0;
                    let error = "ERROR: Password requires at least one capital letter.\n";
                    errorMessage = errorMessage.concat(error);
                }

                // check: password contains at least one number
                if (!/\d/.test(password)) {
                    passFlag = 0;
                    let error = "ERROR: Password requires at least one number.\n";
                    errorMessage = errorMessage.concat(error);
                }

                // check: password contains at least one special character
                if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
                    passFlag = 0;
                    let error = "ERROR: Password requires at least one special character.\n";
                    errorMessage = errorMessage.concat(error);
                }

                return [passFlag, errorMessage];
        }

        function doValidation(event) {
            event.preventDefault();	// prevent the form from submitting by default
            
            // get the string at regMatric then check it
            var accountMatricField = document.getElementById("regMatric");
            var matric = accountMatricField.value;
            var matricResult = checkMatric(matric);
            let mFlag = matricResult[0];
            let mMessage = matricResult[1];
            
            // get the string at regPassword then check it
            var accountPasswordField = document.getElementById("regPassword");
            var password = accountPasswordField.value;
            var passwordResult = checkPassword(password);
            let pFlag = passwordResult[0];
            let pMessage = passwordResult[1];
            
            if (!(pFlag && mFlag)) {
                let errorMessage = mMessage.concat(pMessage);
                popup(errorMessage, "registration.php");
            }
            else {
                document.getElementById("regform").submit();
            }
        }
    </script>
    <header>
        <img class="header" src="images/registrationheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="login.php" class="active">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <h4 style="text-align: center;">Complete this form before accessing the MyStudyKPI system. Required fields are marked with (*)</h4>
        <div id="regformdiv">
            <form id="regform" onsubmit="doValidation(event);" action="action_scripts/registration_action.php" method="post">
                <label for="matricNumber">Matric Number(*)</label><br>
                <input class="regMatric" id="regMatric" name="matricNumber" type="text" required>
                <p style="margin: 0; font-size: 13px;">Matric Number must be in the form of BIXXXXXXXX</p><br>

                <label for="accountEmail">E-mail Address(*)</label><br>
                <input id="fieldreg" name="accountEmail" type="email" required><br>

                <label for="accountPassword">Password (*)</label><br>
                <input class="regPassword" id="regPassword" name="accountPassword" type="password" required>
                <p style="margin: 0; font-size: 13px;">Password must meet the following criteria:</p>
                <P style="margin: 0; font-size: 13px;">• At least 8 characters long</p>
                <p style="margin: 0; font-size: 13px;">• At least one capital letter</p>
                <p style="margin: 0; font-size: 13px;">• At least one digit</p>
                <p style="margin: 0; font-size: 13px;">• At least one special character</p><br>

                <label for="reenterPassword">Reenter Password (*)</label><br>
                <input id="fieldreg" name="reenterPassword" type="password" required><br> 

                <div id="center-content" style="text-align: center">
                    <input id="btnreg" name="signupsubmit" type="submit" value="SUBMIT">
                    <input id="btnreg" name="signupreset" type="reset" value="CLEAR">
                </div>
                <br><br>
            </form>
        </div>
    </main>
    <footer style="position: fixed; bottom: 0;">
        <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>