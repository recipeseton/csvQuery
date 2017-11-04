<?php
include_once('csvQuery.php');
?>

<html>
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="row">
    <div class="col-md-12">

      <?php
      mainQuery('Services-Data.csv', ['program', 'service', 'course', 'section', 'instructor', 'tutor'],['cis', 'test review']);

      ?>

    </div>
  </div>
</body>
</html>
