<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Movies</h1>
        <form method="POST">
        <div class="form-group row">
            <label for="movie" class="col-sm-2 col-form-label">Movie</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="movie" id="movie" placeholder="Movie Name">
            </div><br><br>

            <label for="actor" class="col-sm-2 col-form-label">Actor</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="actor" id="actor" placeholder="Lead Actor">
            </div><br><br>

            <label for="actress" class="col-sm-2 col-form-label">Actress</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="actress" id="actress" placeholder="Lead Actress">
            </div><br><br>

            <label for="year" class="col-sm-2 col-form-label">Year</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="year" id="year" placeholder="Year of Release">
            </div><br><br>

            <label for="director" class="col-sm-2 col-form-label">Director</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="director" id="director" placeholder="Director Name">
            </div><br><br>
        </div>
        <br>
            <button type="submit" class="btn btn-success"  name="add">Add Movie</button>
            <br><br>
            <button type="submit" class="btn btn-primary" name="show">Show All Movies</button>
        </form>
    </div>
    <?php
    include('dbconnection.php');
    if (isset($_POST["show"])) {
        $query = "SELECT * FROM `movies`";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($data);
        //print_r($stmt);
        if ($stmt->rowCount() > 0) {

    ?>
            <br><br>
            <table border="1" align="center" style="width:700px" id="all">
                <!-- <caption>Total Participants: <?php echo $stmt->rowCount(); ?></caption> -->
                <tr border="0" style="border: none;">
                    <th colspan="6" class="text-center">
                        <h3>All Movies</h3>
                    </th>
                </tr>
                <tr>
                    <th>Movie</th>
                    <th>Lead Actor</th>
                    <th>Lead Actress</th>
                    <th>Year of Release</th>
                    <th>Director</th>
                </tr>
                <?php
                foreach ($data as $row) {
                ?>
                    <tr>
                        <td><?php echo $row["Movie Name"]; ?></td>
                        <td><?php echo $row["Lead Actor"]; ?></td>
                        <td><?php echo $row["Lead Actress"]; ?></td>
                        <td><?php echo $row["Year of Release"]; ?></td>
                        <td><?php echo $row["Director"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        } else {
        ?>
            <h3 class="text-center" style="color:#000;">No Records Found</h3>
    <?php
        }
    }

    if (isset($_POST["add"])) {

        $movie = $_POST["movie"];
        $actor = $_POST["actor"];
        $actress = $_POST["actress"];
        $year = $_POST["year"];
        $director = $_POST["director"];

        if(empty($movie) || empty($actor) || empty($actress) || empty($year) || empty($director))
        {
            echo "<br>";
            die ("<h6 align='center'>Please fill the required fields</h6>");
        }
        $ins = "INSERT INTO `movies`(`Movie Name`, `Lead Actor`, `Lead Actress`, `Year of Release`, `Director`) VALUES (:movie,:actor,:actress,:year,:director)";
        $stmt2 = $con->prepare($ins);
        $stmt2->bindParam(':movie', $movie);
        $stmt2->bindParam(':actor', $actor);
        $stmt2->bindParam(':actress', $actress);
        $stmt2->bindParam(':year', $year);
        $stmt2->bindParam(':director', $director);
       
        $result = $stmt2->execute();
        if ($result) {
            echo "<br>";
            echo "<h6 align='center'>Movie '$movie' was Added Successfully!</h6>";
        }
        else
        {
            echo "<h6 align='center'>Something went wrong!</h6>";
        }
    }
    ?>
</body>

</html>