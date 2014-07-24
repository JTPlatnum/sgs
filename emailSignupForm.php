<?php 
  require_once('dbConnect.php');

  if($_POST['action'] == 'signup'){
 
    //sanitize data
    $email = mysql_real_escape_string($_POST['signup-email']);
 
    //validate email address - check if input was empty
    if(empty($email)){
        $status = "error";
        $message = "You did not enter an email address!";
    }
    else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)){ //validate email address - check if is a valid email address
        $status = "error";
        $message = "You have entered an invalid email address!";
    }
    else {
       $existingSignup = mysql_query("SELECT * FROM signups WHERE signup_email_address='$email'");   
       if(mysql_num_rows($existingSignup) < 1){
 
           $date = date('Y-m-d');
           $time = date('H:i:s');
 
           $insertSignup = mysql_query("INSERT INTO signups (signup_email_address, signup_date, signup_time) VALUES ('$email','$date','$time')");
           if($insertSignup){
               $status = "success";
               $message = "   You have been signed up. Thank you!";   
           }
           else {
               $status = "error";
               $message = "   Ooops, Theres been a technical error! Please try again in 15 seconds.";  
           }
        }
        else {
            $status = "error";
            $message = "   This email address has already been registered!";
        }
    }
 
    //return json response 
    $data = array(
        'status' => $status,
        'message' => $message
    );
 
    echo json_encode($data);
 
    exit;
} ?>

<html lang="en" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="author" content="The Sneaker Savant" />
  <meta name="description" content="The World's foremost authority on sneaker grading. Get your sneakers professionally graded today!" />
  <meta name="robots" content="index, follow" />
  <title>The Sneaker Savant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- attach JavaScripts -->
  <script src="js/jquery-1.11.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- attach Google Analytics -->
   <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
     ga('create', 'UA-52181856-1', 'thesneakersavant.com');
     ga('send', 'pageview');
   </script>
  <!-- attach CSS styles -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/emailSignupForm.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=EB+Garamond|Cinzel|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
   <div class="emailSignupHeader text-vcenter">
    <img id="logoType" src="images/TSSFull.png"/>
    <div id="banner_container" class="pad-section">
      <div class="col-sm-3 banner">Premium</div>
      <div class="col-sm-6 banner">
        <h2><i class="glyphicon glyphicon-star"></i>We Grade Sneakers<i class="glyphicon glyphicon-star"></i></h2></div>
      <div class="col-sm-3 banner">Service</div>
    </div>  
      <br>
<!-- service steps section -->
  <div id="services" class="pad-section">
      <div class="container">
        <h2 class="text-center">The Process</h2> <hr />
        <div class="row text-center">
          <div class="col-sm-4 col-xs-6">
            <img src="images/step1.png"/>
            <h4>1. You send us your shoes.</h4>
          </div>
          <div class="col-sm-4 col-xs-6">
            <img src="images/step2.png"/>
            <h4>2. We inspect, grade and package your shoes.</h4>
          </div>
          <div class="col-sm-4 col-xs-6">
             <img src="images/step3.png"/>
            <h4>3. We'll handle the rest. </h4>
          </div>
        </div>
      </div>
    </div>
  <br><br>
    <div id="services_container" class="pad-section">
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title"><img class="medals" src="images/logoCircleSilver.png"/>Silver Service<img class="medals" src="images/logoCircleSilver.png"/></h2>
          </div>
          <div class="panel-body lead">
            <p>
             Our Silver service is provided for our customers with shoes that are meant to be worn. 
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title"><img class="medals" src="images/logoCircleGold.png"/>Gold Service<img class="medals" src="images/logoCircleGold.png"/></h2>
          </div>
          <div class="panel-body lead">
            <p>
            Our Gold service is provided for our customers with shoes that would be great in a museum.
            </p>
          </div>
        </div>
      </div>
    </div>  
    <div class="col-sm-12">
        <img src="images/finalPigeon.png"/>
    </div>
          <br>
          <h3>The final product!</h3>
   </div>
   <div class="emailSignupForm text-vcenter">
        <form id="newsletter-signup" method="post">
          <input type="hidden" value="signup" name="action">
        <fieldset>
            <h3>Interested? Enter your email address below for exclusive offers, promos and discounts!<br><br><label for="signup-email">Sign up today to get 20% off your first order:</label></h3><br>
            <input type="text" name="signup-email" id="signup-email" />
            <input type="submit" id="signup-button" value="Sign Up!" />
            <br><br>
            <p id="signup-response"></p>
        </fieldset>
      </form>
  </div>
  <div class="emailSignupForm text-vcenter">
    <p>Sneaker grading is a method of standardizing and determining the condition and value of a particular pair of shoes. </p>
  </div>
</body>
</html>
                            