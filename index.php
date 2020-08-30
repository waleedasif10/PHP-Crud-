<?php

include('config/db_connect.php');
 //write query
$sql='SELECT name, ingredients, id FROM pizza ORDER BY Created_at';
//make query and get result
$result = mysqli_query($conn, $sql); 

//fetch all the resulting rows
$pizzas= mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

//explode(',', $pizzas[0]['ingredients']);
 ?>



<!DOCTYPE html>
<html lang="en">
  
    <?php include('templates/header.php')?>;
    <h4 class="center grey-text">Pizzas</h4>
    <div class="container">
    <div class="row">
    <?php  foreach($pizzas as $pizza):?>
    
    <div class="col s6 md3">
    <div class="card z-depth-0">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRQWmVGaR_Kl6CDX0xYiqO7lwn5adTLoQMezA&usqp=CAU" alt="" style="float:left;">
    <div class="card-content-center pizza">
    <h3 style="text-align:center"><?php echo htmlspecialchars($pizza['name']);?></h3>
     <ul>
      <?php  foreach(explode(',', $pizza['ingredients']) as $ing): ?>
     <li><?php echo htmlspecialchars($ing) ?></li>
      <?php endforeach; ?>
     </ul>
    </div>
    <div class="card-action right-align">
    <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">More info</a>
    </div>
    </div>
    </div>
    <?php endforeach; ?>
    
    </div>
    </div>
    <?php include('templates/footer.php')?>;

</html>