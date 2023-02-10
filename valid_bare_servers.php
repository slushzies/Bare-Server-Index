<html>
<head>
  <head>
  <title>Bare Server List</title>
  <link rel="stylesheet" type="text/css" href="/stylesheet.css">
</head>
</head>
<body>
  <h1>Valid Bare Servers</h1>
  <ul>
    <?php
      $file = fopen("valid_bare_servers.txt", "r");
      while (!feof($file)) {
        $bare_server_url = trim(fgets($file));
        if (!empty($bare_server_url)) {
          echo "<li>" . $bare_server_url . "</li>";
        }
      }
      fclose($file);
    ?>
  </ul>
</body>
</html>
