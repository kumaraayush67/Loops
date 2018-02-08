<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>loops</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <link rel="stylesheet" href="styles/style.css" media="all"/>
    </head>
    <body>
        <div class="container">
            <div id="header" style="display: block; margin-bottom: 1rem;">
                <a href="index.php" class="brand">Loops</a>
                <form method="post" action="" id="form1" class="form-main" style="float: right;">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="E-mail" required="required">
                        <br/>
                        <input type="password" name="pass" placeholder="*******" required="required">
                        <br/>
                        <br/>
                        <button class="btn btn-primary" type="submit" name="login">Log In</button>
                    </div>
                </form>
            </div>

            <div style="display: block; clear: both;">
                <h3>Create a new account</h3>
                <form action="" method="post" style="display: block;" class="form-main">
                    <div class="form-group">
                        <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="far fa-user"></i>
                        <input type="text" name="fname" placeholder="First Name" required="required">
                        <input type="text" name="lname" placeholder="Last Name" required="required"><br/>
                        <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="far fa-envelope"></i>
                        <input type="email" name="email" placeholder="E-mail" required="required"><br/>
                        <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="fas fa-key"></i>
                        <input type="password" name="pass" placeholder="password" required="required"><br/>
                        <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="fas fa-genderless"></i>
                        <select name="gender" required="required">
                            <option>Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select><br/>
                        <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="fas fa-birthday-cake"></i>
                        <input type="date" name="b_day" placeholder="DD-MM-YYY">
                        <br/>
                        <br/>
                        <button class="btn btn-primary" name="sign_up">Sign Up</button>
                   </div>
                </form>
               <?php 
                   include("user_insert.php")
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      
    </body>
</html>

<?php 
include("login.php");
?>