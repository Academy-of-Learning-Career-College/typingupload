<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
$webhook = 'https://aolccbc.webhook.office.com/webhookb2/1db6062d-7e55-421e-a2d9-d599692916e9@2cba7723-a119-4394-9d02-27aac2d1ed11/IncomingWebhook/ae75ec30ea9b4e4e9a04e9c034e1265e/ea32a7b2-5faf-4585-b298-fb1559f82dca';
if (isset($_POST['submit'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $course = $_POST['course'];
  $file = $_FILES['pdfFile'];

  date_default_timezone_set('America/Vancouver');
$fileName = $firstName . "_" . $lastName . "_" . $course . "_" . date("Y-m-d_H-i-s") . ".pdf";

  
  $fileName = preg_replace("/[^a-zA-Z0-9._-]/", "_", $fileName);
  $fileDestination = "uploads/" . $fileName;

  if (move_uploaded_file($file['tmp_name'], $fileDestination)) {
    $ch = curl_init($webhook);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    echo "File uploaded successfully";
  } else {
    echo "Failed to upload file";
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Typing Results Upload Form</title>
  </head>
  <body>
    <h1>Remote Typing Submission Form</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" required>
      <br><br>
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" required>
      <br><br>
      <label for="course">Course:</label>
      <select id="course" name="course" required>
        <option value="">Select a course</option>
        <option value="Intro to Keyboarding">Intro to Keyboarding</option>
        <option value="Keyboard Skill Building Level 1">Keyboard Skill Building Level 1</option>
        <option value="Keyboard Skill Building Level 2">Keyboard Skill Building Level 2</option>
        <option value="Keyboard Skill Building Level 3">Keyboard Skill Building Level 3</option>
      </select>
      <br><br>
      <label for="pdfFile">PDF File:</label>
      <input type="file" id="pdfFile" name="pdfFile" accept=".pdf" required>
      <br><br>
      <input type="submit" value="Submit" name="submit">
    </form>
  </body>
</html>
