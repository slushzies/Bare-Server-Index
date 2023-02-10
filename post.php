<?php
  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");

  $response = array("status" => "error", "message" => "Invalid request");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data["bare_server_url"])) {
      $bare_server_url = $data["bare_server_url"];
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

      $response["status"] = "success";
      $response["message"] = $validation_result;
    } else {
      $response["message"] = "Missing required parameter: bare_server_url";
    }
  }

  echo json_encode($response);
?>
