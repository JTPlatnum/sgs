<?php 
	if($_GET['action'] == 'signup'){
    mysql_connect('localhost','mapmarki','mapadmin12');  
    mysql_select_db('mapmarki_tss');
 
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
  <link href='http://fonts.googleapis.com/css?family=EB+Garamond|Cinzel' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
 <div class="emailSignupHeader text-vcenter">
    <h2>The Sneaker Savant is about to standardize the Sneaker galaxy. Introducing...</h2>
    <h1>...Professional Sneaker Grading...</h1><br>
<!--       <h3>Don't let others judge your sneakers - we'll do it for you! Let us accurately grade YOUR sneakers; for true collectors, enthusiasts and sneakerheads.</h3>
      <h2>The services we will be offering:</h2> -->
      <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 class="panel-title">Silver Service</h2>
            </div>
            <div class="panel-body lead">
              <p>
               Our Silver service is provided for our customers with shoes that are meant (and still able) to be worn. Red October Yeezy's? This is the service for you. We'll grade and seal them up and give them our classy hang tag. 
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 class="panel-title">Gold Service</h2>
            </div>
            <div class="panel-body lead">
              <p>
              Our Gold service is provided for our customers with shoes that would be great in a museum. Jordan XI "45" Samples? This is your service. We'll grade and stage them in a near-museum quality display case. 
              </p>
            </div>
          </div>
        </div>
        <br>
        <h3>Enter your email address below for exclusive offers, promos and discounts!</h3>
      </div>
   <div class="emailSignupForm text-vcenter">
        <form id="newsletter-signup" action="?action=signup" method="post">
        <fieldset>
            <h3><label for="signup-email">Sign up to get 20% off your first order:</label></h3><br>
            <input type="text" name="signup-email" id="signup-email" />
            <input type="submit" id="signup-button" value="Sign Up!" />
            <br><br>
            <p id="signup-response"></p>
        </fieldset>
      </form>
  </div>
</body>
</html>