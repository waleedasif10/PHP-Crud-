<?php 

	include('config/db_connect.php');

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM pizza WHERE ID = $id_to_delete ";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
	}





if(isset($_GET['id'])){

    $id= mysqli_real_escape_string($conn,$_GET['id']);

    $sql= "SELECT * FROM pizza WHERE ID = $id";

    $result= mysqli_query($conn , $sql);
    $pizza=  mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);

}
?>


<!DOCTYPE html>
<html>
<head>
<title>Waleed's Kitchen</title>
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

	<div class="container center">
		<?php if($pizza): ?>
			<h4><?php echo $pizza['Name']; ?></h4>
			<p>Created by <?php echo $pizza['email']; ?></p>
			<p><?php echo date($pizza['Created_at']); ?></p>
			<h5>Ingredients:</h5>
			<p><?php echo $pizza['ingredients']; ?></p>

			<!-- DELETE FORM -->
			<form action="details.php" method="POST" >
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['ID']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0" >
			</form>

<h4>To Update the Data</h4>
            <form action="details.php" method="POST" id="logform">
				<input type="hidden" name="id_to_update" value="<?php echo $pizza['ID']; ?>" >
                <label for="Name">Enter New Name:</label>
                <input type="text" name="Name" id="Name" required >
				<div class="my-4 err" id="iname"></div>
                <label for="ingredients">Enter New ingredients: (Comma seperated)</label>
                <input type="text" name="ingredients"  id="ingredients" required  >
				<div class="my-4 err" id="ingre"></div>
				<button type="submit" class="btn brand z-depth-0" id="sub" name="update">Update</button>


			</form>


		<?php else: ?>
			<h5>No such pizza exists.</h5>
		<?php endif ?>
	</div>


	<footer class="section">
<div class="center grey-text">Copyright Waleed 2020 </div>
</footer>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

$("#logform").submit(function(event) {


const Name = $('#Name').val();
const ingredients = $('#ingredients').val();



var namereg = /^[A-Za-z]+$/;
var ingredientsreg = /^([a-zA-Z0-9]+,?\s*)+$/;




if (!Name.match(namereg)) {
        $("#iname").html("<span class='alert alert-danger'> Enter Valid Name (Letters only)</span>");
        event.preventDefault();
      }

      if (!ingredients.match(ingredientsreg)) {
        $("#ingre").html("<span class='alert alert-danger'> Enter a valid ingredient with comma seperated </span>");
        event.preventDefault();
      }



e.preventDefault(); // Prevent form from submitting
});

</script>

</body>
</html>

<?php 
	if(isset($_POST['update'])){



		$id_to_update =  mysqli_real_escape_string($conn,$_POST['id_to_update']);
		$sql = "UPDATE pizza
        SET Name = '" . $_POST['Name'] . "',
		ingredients= '" . $_POST['ingredients'] . "'
		
        WHERE ID = $id_to_update";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}

?>