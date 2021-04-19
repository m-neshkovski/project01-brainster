<?php
// DB connection
// require_once('./config.php');
require_once('./config.php');

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
} else {
    // $db = [];

    // Prepare a select statement
    $sql = "SELECT id, full_name, company_name, contact_email, contact_tel, student_type, created_at FROM `vraboti` WHERE 1 ORDER BY created_at DESC";
    
    $query = $pdo->query("$sql");

}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <!-- Custom Fonts needed -->
    <!-- Ubuntu, san-serif-->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet" />
    <!-- Vira Code, monospace -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>

</head>

<body class="bg-light">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0 m-0">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#">Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tools
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="register.php">Register new Your Account</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="reset-password.php">Reset Your Password</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="logout.php" class="btn btn-danger">Sign Out</a>
                            </li>

                        </ul>
                    </div>
                </nav>

            </div>

        </div>

        <div class="row mt-4">
            <div class="col-12 p-0 m-0">
                <div class="page-header text-center">
                    <h1> Најнови барања за наши студенти</h1>
                    <hr>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Име и презиме</th>
                            <th scope="col">Компанија</th>
                            <th scope="col">Контакт имејл</th>
                            <th scope="col">Контакт телефон</th>
                            <th scope="col">Академија</th>
                            <th scope="col">Креиран на</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    
                    if($query->rowCount() != 0){
                        echo '<pre>';
                        $i = 1;
                        while ($row = $query->fetch()) {
                            // print_r($row);
                            echo '<tr>';
                                echo "<th scope='row'>{$i}</th>";
                                echo "<th scope='row'>{$row['full_name']}</th>";
                                echo "<th scope='row'>{$row['company_name']}</th>";
                                echo "<th scope='row'>{$row['contact_email']}</th>";
                                echo "<th scope='row'>{$row['contact_tel']}</th>";
                                echo "<th scope='row'>{$row['student_type']}</th>";
                                echo "<th scope='row'>{$row['created_at']}</th>";
                            echo '</tr>';
                            $i += 1;
                        }
                        
                
                        } else {
                            echo "<tr>";
                                echo "<td colspan=7 class='text-center'>Сеуште нема внесени податоци!!!</td>";
                            echo "</tr>";
                        }

                        // close connection
                        $pdo = NULL;
                    
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        <a href="register.php" class="btn btn-primary">Register new Your Account</a>
    </p> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>
<script src="https://kit.fontawesome.com/280db70b77.js"></script>

</html>