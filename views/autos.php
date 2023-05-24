<!DOCTYPE html>
<html lang="en">
<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <title>Autos</title>
</head>
<body>
  <h1>
    <?php print_r(explode('/', $_SERVER['REQUEST_URI'])[2]); ?>
  </h1>
</body>
</html>