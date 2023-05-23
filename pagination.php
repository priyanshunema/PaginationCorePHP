<?php
    include('connection.php');
    // This is for count all records 
    $result = $connection->query("select * from first");
  
    $row = 0;
    $prev = 0;
    $current = 1; 
    $next = 2;
    $paginationDifference = 10;
    $totalRecord = ceil($result->num_rows/$paginationDifference);
    $activePage = 1;
    $class = '';
    
    if(isset($_GET['pagination']))
    {
        $activePage = $paginationValue = $_GET['pagination'];
        $prev = $activePage-1;
        $current = $activePage; 
        $next = $activePage+1;
        
    }

    $prevclass = $activePage<=1 ? 'd-none' : '';
    $nextclass = $activePage >= $totalRecord ? 'd-none' : '';


    $startpage = ($activePage-1)*$paginationDifference;
    $startpage = $startpage<=0 ? 1 : $startpage;
    $sqlforpagination = "select * from first limit $startpage,10";
    $result = $connection->query($sqlforpagination);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">

<div class="text-center display-2 text-danger bg-dark container">Pagination </div>
<table class="table container center mt-5 text-center ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $item) {    ?> 
    <tr>
      <th scope="row"><?php echo ++$row  ?></th>
      <td><?php echo $item['name']  ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
   
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item  <?php echo $prevclass ?>">
      <a class="page-link" href="?pagination=<?php echo $activePage-1 ?>" tabindex="-1">Previous</a>
    </li>
    <li class="page-item <?php echo $prevclass ?>">
        <a class="page-link" href="?pagination=<?php echo $prev ?>">
            <?php echo $prev ?>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link bg-warning" href="?pagination=<?php echo $current ?>">
            <?php echo $current ?>
        </a>
    </li>
    <li class="page-item <?php echo $nextclass ?>">
        <a class="page-link" href="?pagination=<?php echo $next ?>">
            <?php echo $next ?>
        </a>
    </li>
    <li class="page-item <?php echo $nextclass ?>">
      <a class="page-link" href="?pagination=<?php echo $activePage+1 ?>">Next</a>
    </li>
  </ul>
</nav>
</div>    

</body>
</html>