<?php
include 'config.php';
include 'db.php';
include 'inc/headers.inc.php';
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
  <title>
    i20
  </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./scripts/notify.js"></script>
</head>

<body>
  <header>
    <div class="header-block">
      <?= $reference ?>
      <h1 class="header-text"><?= "$header" ?></h1>
    </div>
  </header>
  <main>
    <?php
    include 'inc/routing.inc.php';
    ?>
  </main>
  <script src=" ./scripts/script.js"></script>
</body>