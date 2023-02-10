<?php
  header("Content-Type: application/json");

  $file = fopen("valid_bare_servers.txt", "r");
  $bare_servers = array();
  while (!feof($file)) {
    $bare_servers[] = trim(fgets($file));
  }
  fclose($file);
  
  $random_index = array_rand($bare_servers);
  $random_bare_server = $bare_servers[$random_index];
  
  echo json_encode(array("bare_server_url" => $random_bare_server), JSON_UNESCAPED_SLASHES);
?>
