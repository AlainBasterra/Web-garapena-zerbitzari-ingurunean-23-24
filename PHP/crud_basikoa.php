<?php
include_once("./datu_basea.php");
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>CRUD Basikoa</title>
</head>


<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];


    switch ($action) {
        case 'create':
            $izena = $_POST['izenaC'];
            $adina = $_POST['adinaC'];
            $jaiotza_data = $_POST['jaiotza_dataC'];
            $altuera = $_POST['altueraC'];

            $sql = "INSERT INTO ariketa_crud (izena, adina, jaiotza_data, altuera) VALUES ('$izena','$adina','$jaiotza_data','$altuera')";
            $mysqli->query($sql);
            break;

        case 'read':
            break;

        case 'update':
            $id = $_POST['idU'];
            $izena = $_POST['izenaU'];
            $adina = $_POST['adinaU'];
            $jaiotza_data = $_POST['jaiotza_dataU'];
            $altuera = $_POST['altueraU'];

            $sql = "UPDATE ariketa_crud SET izena='$izena', adina='$adina', jaiotza_data='$jaiotza_data', altuera='$altuera' WHERE id='$id'";
            $mysqli->query($sql);

            break;

        case "delete":
            $id = $_POST['idD'];

            $sql = "DELETE FROM ariketa_crud WHERE id='$id'";
            $mysqli->query($sql);
            break;

        default:
            break;
    }
}
?>


<body>
    <div class="container">
        <h1 class="text-center">CRUD BASIKOA</h1><br>
        <div class="row">
            <div class="col-lg-6 p-3"> <!-- CREATE -->
                <div class="rounded bg-light shadow border p-3">
                    <h2 class="text-center">CREATE</h2>
                    <form action="./crud_basikoa.php?action=create" method="post">
                        <div class="mb-3">
                            <label for="izenaC" class="form-label">Izena</label>
                            <input type="text" class="form-control" id="izenaC" name="izenaC">
                        </div>
                        <div class="mb-3">
                            <label for="adinaC" class="form-label">Adina</label>
                            <input type="number" class="form-control" min="0" id="adinaC" name="adinaC">
                        </div>
                        <div class="mb-3">
                            <label for="jaiotza_dataC" class="form-label">Jaiotza Data</label>
                            <input type="text" class="form-control" id="jaiotza_dataC" name="jaiotza_dataC">
                        </div>
                        <div class="mb-3">
                            <label for="altueraC" class="form-label">Altuera</label>
                            <input type="number" class="form-control" id="altueraC" name="altueraC" min="0" step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary" name="gorde">Sortu</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 p-3"> <!-- READ -->
                <div class="rounded bg-light shadow border p-3">
                    <h2 class="text-center">READ</h2>
                    <?php
                    $sql = "SELECT * FROM ariketa_crud";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Izena</th>
                                    <th scope="col">Adina</th>
                                    <th scope="col">Jaiotza data</th>
                                    <th scope="col">Altuera</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo ("
                                    <tr>
                                        <th scope='row'>$row[id]</th>
                                        <td>$row[izena]</td>
                                        <td>$row[adina]</td>
                                        <td>$row[jaiotza_data]</td>
                                        <td>$row[altuera] m</td>
                                    </tr>
                                    ");
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "Ez dago daturik";
                    }
                    ?>
                    <a href="./crud_basikoa.php" class="btn btn-primary self-right"><i
                            class="bi bi-arrow-clockwise"></i></a>

                </div>
            </div>
            <div class="col-lg-6 p-3"> <!-- UPDATE -->
                <div class="rounded bg-light shadow border p-3">
                    <h2 class="text-center">UPDATE</h2>
                    <form action="./crud_basikoa.php?action=update" method="post">
                        <div class="mb-3">
                            <label for="idU" class="form-label">ID</label>
                            <input type="number" class="form-control" id="idU" name="idU">
                        </div>
                        <div class="mb-3">
                            <label for="izenaU" class="form-label">Izena</label>
                            <input type="text" class="form-control" id="izenaU" name="izenaU">
                        </div>
                        <div class="mb-3">
                            <label for="adinaU" class="form-label">Adina</label>
                            <input type="number" class="form-control" min="0" id="adinaU" name="adinaU">
                        </div>
                        <div class="mb-3">
                            <label for="jaiotza_dataU" class="form-label">Jaiotza Data</label>
                            <input type="text" class="form-control" id="jaiotza_dataU" name="jaiotza_dataU">
                        </div>
                        <div class="mb-3">
                            <label for="altueraU" class="form-label">Altuera</label>
                            <input type="number" class="form-control" id="altueraU" name="altueraU" min="0" step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary" name="gorde">Eguneratu</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 p-3"> <!-- DELETE -->
                <div class="rounded bg-light shadow border p-3">
                    <h2 class="text-center">DELETE</h2>
                    <form action="./crud_basikoa.php?action=delete" method="post">
                    <div class="mb-3">
                            <label for="idD" class="form-label">ID</label>
                            <input type="number" class="form-control" id="idD" name="idD">
                        </div>
                        <button type="submit" class="btn btn-primary" name="gorde">Ezabatu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




</body>

</html>