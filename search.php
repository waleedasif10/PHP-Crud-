<?php

include('config/db_connect.php');


if (isset($_POST['keyword'])) {
    // Filter
    $keyword = trim ($_POST['keyword']);
    
    // Select statement
    $search = "SELECT * FROM pizza WHERE Name LIKE '%$keyword%'";
    // Display
    $result = mysqli_query($conn,$search) or die('query did not work');
    
    $pizzas= mysqli_fetch_all($result, MYSQLI_ASSOC);


    $anymatches=mysqli_num_rows($result); 
    if ($Keyword='') 
    { 
       echo "Nothing was found that matched your query.<br><br>"; 
    }
    }
    else{
        ?>
        <style type="text/css">#pizza{
        display:none;
        }</style>
        <?php

        }
        
?>


<!DOCTYPE html>
<html lang="en">
  
   <?php include('templates/header.php')?>

   <form action="search.php" method="post">
<input type="text" name="keyword">
<input type="submit" name="search" value="Search">

<h4 class="center grey-text">Pizzas</h4>
    <div class="container" id='pizza'>
    <div class="row" style="float:left;">
   
    <?php  foreach($pizzas as $pizza):?>
    
        <div class="col s10 md3" style=" background:white; margin:50px">
    <div class="card z-depth-0">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRQWmVGaR_Kl6CDX0xYiqO7lwn5adTLoQMezA&usqp=CAU" alt="" style="float:left;">
    <div class="card-content-center pizza">
    <h3><?php echo htmlspecialchars($pizza['Name'])?></h3>
     <ul>
      <?php  foreach(explode(',', $pizza['ingredients']) as $ing): ?>
     <li><?php echo htmlspecialchars($ing) ?></li>
      <?php endforeach; ?>
     </ul>
    </div>
    <div class="card-action right-align">
    <a href="details.php?id=<?php echo $pizza['ID']?>" class="brand-text">More info</a>
    </div>
    </div>
    </div>
    <?php endforeach; ?>
   

</div>    
</div>
    <?php include('templates/footer.php')?>

</html>