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
    $to = $_POST['person'];
    $subject = "File Uploaded";
    $message = "A file has been uploaded and is available at this link: " . $fileDestination;
    $headers = "From: no-reply@aolccbc.com\r\n";
    if (mail($to, $subject, $message, $headers)) {
      echo "Email sent successfully.";
    } else {
      echo "Email sending failed.";
    }

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <img src="logo.png" alt="" class="logo">
  <h1>Remote Typing Submission Form</h1>
  <p>As you are working from home, please see the below instructions for your keyboarding course: </p>
  <ol>
    <li>Complete ALL Lessons and ALL Self-Tests in Typing Trainer. </li>
    <li>Attain an average net typing speed on the Typing Trainer Self-Tests equal to or above the required minimum WPM
      for the course.
      <aside>Note:

        All Lesson WPM results are gross WPM with no reduction due to errors made, while Self-Tests are Net WPM, which
        reduces the resulting WPM based on the number of errors committed. 
        The required minimum WPM for the course is the net WPM.
        <ul>
          <li>Introduction to Keyboarding: 10 <i>NET</i> WPM</i>
          <li>Keyboard Skill Building Level 1: 25 <i>NET</i> WPM</i>
          <li>Keyboard Skill Building Level 2: 40 <i>NET</i> WPM</i>
          <li>Keyboard Skill Building Level 3: 55 <i>NET</i> WPM</i>
          


</ul>
  <br />
        In addition, the keyboarding course is meant to be done at the same time as your other courses. Please work on
        your typing for at least 30 minutes a day.</aside>
    </li>
    <li>Once you’ve attained an average net typing speed equal to or above the required minimum WPM for the course,
      submit your results as described below.
      This will result in a pass in the course with a mark equal to the minimum passing WPM.</li>
    <li>Print out the progress report by clicking the Print Progress button. Select the Microsoft Print to PDF printer
      and save it to your desktop as Keyboarding Results</li>
    <form action="" method="post" enctype="multipart/form-data">
      <li>Enter your name here:
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
</li>

<li>
  Select the Keyboarding course: 
  <label for="course">Course:</label>
  <select id="course" name="course" required>
    <option value="">Select a course</option>
    <option value="Intro to Keyboarding">Intro to Keyboarding</option>
    <option value="Keyboard Skill Building Level 1">Keyboard Skill Building Level 1</option>
    <option value="Keyboard Skill Building Level 2">Keyboard Skill Building Level 2</option>
    <option value="Keyboard Skill Building Level 3">Keyboard Skill Building Level 3</option>
  </select>
</li>
<li><label for="person">Select Person to send your typing report to:</label>
<select id="person" name="person" required>
  <option value="">Select a person</option>
  <option value="brittany@aolccbc.com">Brittany</option>
  <option value="mike@aolccbc.com">Michael</option>
  <option value="rod@aolccbc.com">Rod</option>
  <option value="leo@aolccbc.com">Leo</option>
</select></li>
<li>

  <label for="pdfFile">Select your typing report:</label>
  <input type="file" id="pdfFile" name="pdfFile" accept=".pdf" required>
</li>
<li>
  <input type="submit" value="Click here to Send your Report" name="submit">

</li>  
</ol>
  
  </form>

</body>

</html>