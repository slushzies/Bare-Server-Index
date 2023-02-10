<html>
<head>
  <title>Bare Server Index</title>
  <link rel="stylesheet" type="text/css" href="/stylesheet.css">
</head>
<body>
<div class="container">
  <h1>Bare Server Index</h1>
  <label>Post bare servers here! You can send a POST request to post.php with </br>json of bare_server_url set to a URL or send a GET request to random.php and get a random BARE server.</label>
  <hr>
  <form action="index.php" method="post">
    <label for="bare_server_url">Bare Server URL:</label>
    <input type="text" id="bare_server_url" name="bare_server_url">
    <input type="submit" value="Submit">
  </form>
  <table>
    <thead>
      <tr>
        <th>URL</th>
        <th>Validation Result</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if (isset($_POST['bare_server_url'])) {
          $bare_server_url = $_POST['bare_server_url'];
          $github_repo_url = "https://github.com/tomphttp/bare-server-node";
          $validation_result = "Valid";
          
          // Normalize the URL by converting to lowercase, and using "https" scheme
          $bare_server_url = strtolower($bare_server_url);
          $bare_server_url = preg_replace("/^http:/", "https:", $bare_server_url);
          
          $bare_server_contents = @file_get_contents($bare_server_url);
          
          if ($bare_server_contents === false || strpos($bare_server_contents, $github_repo_url) === false) {
            $validation_result = "Invalid";
          } else {
            // Check for duplicates before writing to file
            $file = fopen("valid_bare_servers.txt", "a+");
            $duplicate = false;
            while (!feof($file)) {
              $existing_bare_server_url = trim(fgets($file));
              if (strtolower($existing_bare_server_url) == $bare_server_url) {
                $duplicate = true;
                break;
              }
            }
            if (!$duplicate) {
              fwrite($file, $bare_server_url . "\n");
            } else {
              $validation_result = "Duplicate";
            }
            fclose($file);
          }
          
          echo "<tr>";
          echo "<td>" . $bare_server_url . "</td>";
          echo "<td>" . $validation_result . "</td>";
          echo "</tr>";
          echo "<h2>Thank you for contributing!<h2>";
        }
      ?>
    </tbody>
  </table>
  <p><a href="valid_bare_servers.php">View List of Valid Bare Servers</a></p>
</body>
</html>
</div>
