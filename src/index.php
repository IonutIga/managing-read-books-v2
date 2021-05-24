<?php
    require_once "./components/header.php"
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./assets/images/icon.png" type="image/x-icon"/>
        <title>Login</title>
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/header.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
        <script>
            function trimite(codpostal)
            {
                let email = document.getElementById('email').value;
                let pass = document.getElementById('password').value;
                
                if(email.length>0 && pass.length>0){
                    adresa="../backend/login.php"
                    dateDeTrimis=$('#login-content').serializeArray();
                    $.post(adresa, dateDeTrimis, procesareRaspuns);
                }else{
                    document.getElementById('error-message').style = 'display:visible; color:white; padding-bottom:1%';
                }

            }
            function procesareRaspuns(raspuns)
	        { 
                if(raspuns==200){
                    window.location.href = 'pages/books.php';	    
                }else{
                    alert('Wrong username or password!');
                    console.log(raspuns);
                }
            }
        </script>   
        
        <header>
            <nav>
                <?=navbar() ?> 
            </nav>
        </header>

        <div class="intro">
                <p>This application is intended to manage the books you read.</p><br>
                <p>Step 1: Create an account in register.</p>
                <p>Step 2: Logged in to the created account.</p>
                <p>Step 3: Add a read book.</p>
        </div>
        <main>
            <div class="login-form">
                <div class="login-header">
                    <a id="log">Login</a> | <a href="./pages/register.php" id="reg">Register</a>
                </div>
                <form id="login-content">
                    <input type="email" id="email" name="email" placeholder="Email" require>
                    <input type="password" id="password" name="password" placeholder="Password" require>
                </form>
                <button type="submit" id="login-submit" onclick='trimite()'>Submit</button>
                <p id="error-message" style="display:none;">Fill in all the fields!</p>
            </div>
        </main>

         <footer>
            <div class="copyright">
                <p>&#169;Copyright 2021 by Ionut and Daniel. All Rights Reserved.</p>
            </div>
        </footer>
    </body>
</html>