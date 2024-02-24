<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="result.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="images/logo/e.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/font/css/all.css">
    <title>Document</title>
</head>
<body>


<?php
session_start();

// Add the movie to the favorite list
if (isset($_GET['add_to_favorite'])) {
    $movieTitle = $_GET['add_to_favorite'];
    $_SESSION['favorite_list'][] = $movieTitle;
}

// Remove the movie from the favorite list
if (isset($_GET['remove_from_favorite'])) {
    $movieTitle = $_GET['remove_from_favorite'];
    if (($key = array_search($movieTitle, $_SESSION['favorite_list'])) !== false) {
        unset($_SESSION['favorite_list'][$key]);
    }
}

// Redirect back to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);


exit();
?>




</body>
</html>


