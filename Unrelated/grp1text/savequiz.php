<?php
session_start();
require("connect.php");

header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
  echo "User not logged in.";
  exit;
}

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['quizData']) || !isset($data['quizTitle'])) {
  echo "Invalid data.";
  exit;
}

$quizTitle = mysqli_real_escape_string($connection, $data['quizTitle']);
$terms = $data['quizData']; // array of {term, definition}

$response = ["status" => "error", "message" => "Unknown error."];

// Step 1: Insert into tblQuizzes
$insertQuiz = "INSERT INTO tblQuizzes (user_id, title_id) VALUES ('$user_id', '$quizTitle')";
if (!mysqli_query($connection, $insertQuiz)) {
  echo "Failed to insert into tblQuizzes: " . mysqli_error($connection);
  exit;
}
$quiz_id = mysqli_insert_id($connection);

// Step 2: Insert into tblQuizTermsAndDefinitions
foreach ($terms as $pair) {
  $term = mysqli_real_escape_string($connection, $pair['term']);
  $definition = mysqli_real_escape_string($connection, $pair['definition']);

  $insertTerm = "INSERT INTO tblQuizTermsAndDefinitions (quiz_id, termss, definitionss)
                 VALUES ('$quiz_id', '$term', '$definition')";
  if (!mysqli_query($connection, $insertTerm)) {
    echo "Failed to insert into tblQuizTermsAndDefinitions: " . mysqli_error($connection);
    exit;
  }
}

// Step 3: Insert into tblProjects
$insertProject = "INSERT INTO tblProjects (title_id, email) VALUES ('$quizTitle', '$email')";
if (!mysqli_query($connection, $insertProject)) {
  echo "Failed to insert into tblProjects: " . mysqli_error($connection);
  exit;
}
$project_id = mysqli_insert_id($connection);

// Step 4: Copy from tblQuizTermsAndDefinitions → tblProjectItems
$getTerms = "SELECT termss, definitionss FROM tblQuizTermsAndDefinitions WHERE quiz_id = '$quiz_id'";
$result = mysqli_query($connection, $getTerms);

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $term = mysqli_real_escape_string($connection, $row['termss']);
    $definition = mysqli_real_escape_string($connection, $row['definitionss']);

    $insertItem = "INSERT INTO tblProjectItems (project_id, termss, definitionss)
                   VALUES ('$project_id', '$term', '$definition')";
    if (!mysqli_query($connection, $insertItem)) {
      echo "Failed to insert into tblProjectItems: " . mysqli_error($connection);
      exit;
    }
  }
} else {
  echo "Failed to retrieve terms from tblQuizTermsAndDefinitions.";
  exit;
}

// Step 5: Link items to quiz in tblQuizItems
$getItems = "SELECT project_item_id FROM tblProjectItems WHERE project_id = '$project_id'";
$itemResults = mysqli_query($connection, $getItems);

if ($itemResults) {
  while ($row = mysqli_fetch_assoc($itemResults)) {
    $item_id = $row['project_item_id'];
    $link = "INSERT INTO tblQuizItems (quiz_id, project_item_id) VALUES ('$quiz_id', '$item_id')";
    if (!mysqli_query($connection, $link)) {
      echo "Failed to insert into tblQuizItems: " . mysqli_error($connection);
      exit;
    }
  }
} else {
  echo "Failed to fetch project items.";
  exit;
}

echo "success";
?>
