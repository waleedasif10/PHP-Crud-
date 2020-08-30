<?php

include('config/db_connect.php');


if(isset($_POST['submit'])){


   
   $email= mysqli_real_escape_string($conn, $_POST['email']);
   $title= mysqli_real_escape_string($conn,$_POST['title']);
   $ingredients= mysqli_real_escape_string($conn,$_POST['ingredients']);

   $sql= "INSERT INTO pizza(Name,email,ingredients) VALUES ('$title','$email','$ingredients')";
       
   if(mysqli_query($conn,$sql)){

   }else{
     echo 'query error:'.mysqli_error($conn);
   }
    header('Location: index.php');
  }
 
?>
<!DOCTYPE html>
<html>
	
<head>
<title>Waleed's Kitchen </title>
 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <style>
 .brand{
    background:#cbb09c !important;
 }
 .brand-text{
    color: #cbb09c !important;
 }

form{
   max-width:460px;
   margin:20px auto;
   padding:20px;
}

.pizza{

width :450px;
height: 300px;
}


 </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
       <div class="container">
          <a href="index.php" class="brand-logo brand-text">Waleed's Kitchen</a>
          <ul id="nav-mobile" class="right hide-on-small-and-down">
              <li><a href="add.php" class="btn brand z-depth-0">Add a Pizza</a></li>
              <li><a href="search.php" class="btn brand z-depth-0">Search</a></li>

          </ul>
       </div>
    </nav>
	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST" id="logform">
			<label>Your Email</label>
			<input type="text" name="email"  id="email" required >
      <div class="my-4 err" id="Email" ></div>
			<label>Pizza Title</label>
			<input type="text" name="title" id="Name" required >
      <div class="my-4 err" id="iname"></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients"  id="ingredients" required >
      <div class="my-4 err" id="ingre"></div>
			<div class="center">
        <button type="submit" class="btn brand z-depth-0" name="submit">Add</button>

			</div>
		</form>
	</section>


  <footer class="section">
<div class="center grey-text">Copyright Waleed 2020 </div>
</footer>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

$("#logform").submit(function(event) {

const Email = $('#email').val();
const Name = $('#Name').val();
const ingredients = $('#ingredients').val();



var namereg = /^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$/;
var ingredientsreg =/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/;
var Emailreg=/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;


if (!Email.match(Emailreg)) {
        $("#Email").html("<span class='alert alert-danger'> Enter a valid Email </span>");
        event.preventDefault();
      }

if (!Name.match(namereg)) {
        $("#iname").html("<span class='alert alert-danger'> Enter Valid Name (Letters only)</span>");
        event.preventDefault();
      }

      if (!ingredients.match(ingredientsreg)) {
        $("#ingre").html("<span class='alert alert-danger'> Enter a valid ingredient with comma seperated </span>");
        event.preventDefault();
      }



});

</script>

</body>
</html>