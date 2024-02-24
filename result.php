
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="result.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="images/logo/e.png">
    <link rel="stylesheet" href="/font/css/all.css">
    
    
    <title>CineVerse</title>
</head>
<body>
<header class="header" id="header">
        <div class="logo">
            <h1>CineVerse</h1>
        </div>
        <div class="search">
            <form action="result.php" method="GET">
                <input type="search" name="search" placeholder="Find your Film, Category, or actor" id="search">
                <button type="submit"><i class="fas fa-search"></i></button>

            </form>
        </div>
        <div class="btns">
            <ul class="links">
                <li><a href="main.php">HOME</li>
                <li>About us</li>
                <li>Contact us</li>
 
            </ul>
            

        </div>
    </header>
    <main class="main_body">
        <aside class="side_bar">
            <ul class="side_bar_btns">
                <li><i class="fas fa-film"></i><a href="">All Films</a></li>
                <li><i class="fas fa-tv"></i></i><a href="">Tv shows</a></li>
                <li><i class="fas fa-file-video"></i></i><a href="">Documentary</a></li>
                <li><i class="fas fa-photo-video"></i></i><a href="">Anime</a></li>

            </ul>
        </aside>
    <h1>The Movie you are Looking for</h1>
    <div class="container">

    <?php
        // Start the session
        session_start();


        // Check if the favorite list exists in the session
        if (!isset($_SESSION['favorite_list'])) {
            $_SESSION['favorite_list'] = array();
        }

        // Display the favorite list
        if (!empty($_SESSION['favorite_list'])) {
            echo '<div class="favorite-list">';
            echo '<h2>Favorite List</h2>';
            foreach ($_SESSION['favorite_list'] as $movieTitle) {
                echo '<p>' . $movieTitle . '</p>';
            }
            echo '</div>';
        }

        // Connect to the database
        $servername = "127.0.0.1";
        $username = "root";
        $password = "Mm03201604";
        $dbname = "sakila";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the movie name from the user input
        $movieName = $_GET['search'];

        // Prepare and execute the SQL query
        $sql = "SELECT film.film_id, film.description, film.release_year, film.rating, category.name, film.title
                FROM film
                JOIN film_category ON film.film_id = film_category.film_id
                JOIN category ON film_category.category_id = category.category_id
                WHERE film.title LIKE '%$movieName%'";
        $result = $conn->query($sql);

        // Check if any movies were found
        if ($result->num_rows > 0) {
            echo '<div class="movie-results">';
            // Display the movies
            while ($row = $result->fetch_assoc()) {
                echo '<div class="movie">';
                echo '<h3 class="movie-title">' . $row["title"] . '</h3>';
                echo '<p class="movie-description">Description: ' . $row["description"] . '</p>';
                echo '<p class="movie-release">Release Year: ' . $row["release_year"] . '</p>';
                echo '<p class="movie-rating">Rating: ' . $row["rating"] . '</p>';
                echo '<p class="movie-category">Category: ' . $row["name"] . '</p>';

                // Check if the movie is already in the favorite list
                if (in_array($row["title"], $_SESSION['favorite_list'])) {
                    echo '<a href="Favorite.php?remove_from_favorite=' . $row["title"] . '"><i class="fas fa-heart"></i></a>';
                } else {
                    echo '<a href="Favorite.php?add_to_favorite=' . $row["title"] . '"><i class="far fa-heart"></i></a>';
                }

                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="not-found">No movies found.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>

    </div>
    <footer>


</footer>

</body>

</html>

