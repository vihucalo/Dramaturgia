<?php
define('OBRAS_TABLE', 'listaautores');
define('_DB_HOST', 'localhost');
define('_DB_USER', 'Dramaturgia');
define('_DB_PASSWORD', '1234123121');
define('_DB_NAME', 'prueba');
define('CATEGORIA', 'representativo');


$db_connection = new mysqli(_DB_HOST, _DB_USER, _DB_PASSWORD, _DB_NAME);

if ($db_connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $db_connection->connect_error;
    exit();
}

function get_data($data)
{
    if (isset($_GET[$data])) {
        $info = $_GET[$data];
        return $info;
    } else {
        return NULL;
    }
}

function query($db_connection, $table, $categoria)
{
    $query = "SELECT * FROM `$table` WHERE `categoria` = '$categoria'";
    if (!($result = $db_connection->query($query))) {
        throw new Exception("Query ($query) failed: $db_connection->error");
    }
    #return $result->fetch_all(MYSQLI_ASSOC);
    return  $result;
}


function query1($db_connection, $tabla, $data_name, $data, $categoria)
{
    $query = "SELECT * FROM `$tabla` WHERE `$data_name` LIKE '%$data%' AND `categoria` = '$categoria'";
    if (!($result = $db_connection->query($query))) {
        throw new Exception("Query ($query) failed: $db_connection->error");
    }
    return $result;
}

function query2($db_connection, $tabla, $array)
{
    $consulta = "";
    $bandera = TRUE;

    foreach ($array as $key => $value) {
        if (empty($value) === FALSE) {
            if ($bandera === TRUE) {
                $consulta .= "WHERE `" . $key . "`='" . $array[$key] . "'";
                $bandera = FALSE;
            } else {
                $consulta .= ' and `' . $key . "`='" . $array[$key] . "'";
            }
        }
    }
    $query = "SELECT * FROM `$tabla` $consulta";
    if (!($result = $db_connection->query($query))) {
        throw new Exception("Query ($query) failed: $db_connection->error");
    }
    return $result;
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .btn {
            color: white;
            background: #e9572e;
            border: 2px solid #e9572e;
        }

        .btn:hover {
            color: #e9572e;
            background: white;
        }

        .field {
            margin-right: 5px;
            border: 2px solid #e9572e;
        }
    </style>

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <form class="input-group input-group-sm mb-3" action="vista.php" method="GET">
            <input type="text" class="form-control field" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="nombre" name="nombre_obra">
            <input type="text" class="form-control  field" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="autor" name="autor">
            <input type="text" class="form-control  field" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="pais" name="pais">
            <input type="number" class="form-control  field" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="femenino" name="femenino">
            <input type="number" class="form-control  field" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="masculino" name="masculino">
            <input type="number" class="form-control  field" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="otro" name="otros">
            <input type="submit" class="form-control btn" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="Buscar" name="buscar">
        </form>
        <div class="container">
            <table class="table table-warning table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Pais</th>
                        <th scope="col">Femenino</th>
                        <th scope="col">Masculino</th>
                        <th scope="col">Otros</th>
                        <th scope="col">Descargas</th>
                        <th scope="col">Descargar</th>
                        <a href=''></a>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_GET['buscar'])) {
                        $obra = get_data('nombre_obra');
                        $autor = get_data('autor');
                        $pais = get_data('pais');
                        $femenino = get_data('femenino');
                        $masculino = get_data('masculino');
                        $otro = get_data('otros');
                        $array = array(
                            "nombre_obra"  => $obra,
                            "autor"  => $autor,
                            "pais" =>  $pais,
                            "femenino"  => $femenino,
                            "masculino"  => $masculino,
                            "otro"  =>  $otro
                        );
                        $result = query2($db_connection, OBRAS_TABLE, $array);

                        // $row = $result->fetch_array(MYSQLI_ASSOC);
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<th scope='col'>" . $row['nombre_obra'] . "</th>";
                            echo "<th scope='col'>" . $row['autor'] . "</th>";
                            echo "<th scope='col'>" . $row['pais'] . "</th>";
                            echo "<th scope='col'>" . $row['femenino'] . "</th>";
                            echo "<th scope='col'>" . $row['masculino'] . "</th>";
                            echo "<th scope='col'>" . $row['otros'] . "</th>";
                            echo "<th scope='col'> <div id='" . $row['id'] . "d'>" . $row['descargas'] . "</div> </th>";
                            echo "<th scope='col'><a href='" . $row['url_doc'] . "'><input class='btn btn-primary' type='button' value='Descargar' onclick='setdowload(" . $row['id'] . ")'></a></th>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        function setdowload(id) {
            let ids = id + "d";
            let html = document.getElementById(ids);
            let number = html.innerText;
            let suma = parseInt(number, 10) + 1;
            html.innerHTML = suma + " ";
            console.log(suma);
            
            $.ajax({
                url: "aumentar.php",
                type: "post",
                data: {
                    ids: id,
                    funcion: "aumentar"
                },
                success: function(response) {
                    console.log(response);
                }
            });


        }
    </script>
</body>

</html>