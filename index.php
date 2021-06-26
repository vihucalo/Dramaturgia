<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>DataTables</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    
      
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">  
  </head>
    
  <body> 
     <header>
     <h3 class='text-center'></h3>
     </header>    
        <?php

                define('DEBUG', FALSE);

                define('OBRAS_TABLE', 'listaautores');
                define('_DB_HOST', 'localhost');
                define('_DB_USER', 'Dramaturgia');
                define('_DB_PASSWORD', '1234123121');
                define('_DB_NAME', 'drama_db');
                define('CATEGORIA','representativo');


                function get_data($data) {
                        if (isset($_POST[$data])) {
                                $info = $_POST[$data];
                            return $info;
                        }
                        else{ 
                                return NULL;
                        }
                }

                function get_db_connection() {
                        $db_connection = new mysqli(_DB_HOST, _DB_USER, _DB_PASSWORD, _DB_NAME);
                        if ($db_connection->connect_errno) {
                            throw new Exception(
                                "Failed to connect to the DB: $db_connection->connect_error");
                        }
                        if (!$db_connection->set_charset('utf8')) {
                            throw new Exception(
                                "Failed to set the charset to utf-8: : $db_connection->error");
                        }
                        return $db_connection;
                }

                function query($db_connection, $table, $category) {
                        $query = "SELECT * FROM `$table` WHERE `categoria` = '$category'";
                         if (!($result = $db_connection->query($query))) {
                            throw new Exception("Query ($query) failed: $db_connection->error");
                        }        
                        return $result->fetch_all(MYSQLI_ASSOC);
                }

                function query1($db_connection, $tabla, $data_name,$data) {
                         $query = "SELECT * FROM `$table` WHERE `$data_name` = $data";
                         if (!($result = $db_connection->query($query))) {
                            throw new Exception("Query ($query) failed: $db_connection->error");
                        }        
                        return $result->fetch_all(MYSQLI_ASSOC);
                }

                function get_info($db_connection, $category) {
                         if (!($obras = query($db_connection, OBRAS_TABLE, CATEGORIA))) {
                            throw new InvalidArgumentException("Obra no encontrada");
                        }
                        return $obras;
                        }

                function get_obra($db_connection, $obra=NULL, $autor=NULL, $pais=NULL, $femenino=NULL, $masculino=NULL, $otro=NULL) {
                        $obras1 = array();
                        $obras2 = array(); 
                        $obras3 = array(); 
                        $obras4 = array(); 
                        $obras5 = array(); 
                        $obras6 = array();
                        foreach (array_keys(DATA_DICTIONARY) as $table) {
                            if($obra!=NULL){
                                    $obras1[$table] = query1($db_connection, $table, 'nombre_obra', $obra);
                            }
                            else if ($autor!=NULL){
                                    $obras2[$table] = query1($db_connection, $table, 'autor', $autor);
                            }
                            else if ($pais!=NULL){
                                    $obras3[$table] = query1($db_connection, $table, 'pais', $pais);
                            }
                            else if ($femenino!=NULL){
                                    $obras4[$table] = query1($db_connection, $table, 'femenino', $femenino);
                            }
                            else if ($masculino!=NULL){
                                    $obras5[$table] = query1($db_connection, $table, 'masculino', $masculino);
                            }
                            else if ($otro!=NULL){
                                    $obras6[$table] = query1($db_connection, $table, 'otro', $otro);
                            }
                        }
                        $obras = array_merge($obras1, $obras2, $obras3, $obras4, $obras5, $obras6);
                        return $obras;
                }

                function generate_html($obras) {
                        
                        foreach ($obras as $table => $rows) {
                            generate_rows($table, $rows);
                        }
                }

                function generate_rows($table, $rows) {
                    foreach($rows as $row) {
                          #  $fields = DATA_DICTIONARY[$rows];
                            echo "<p><strong>$row<p>\n";
                    }

                }
                
        ?>
                        
                        
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">            
                    <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">library_add</i></button>    
                    </div>    
                </div>    
        </div>    
    <br> 

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">

                        <tr>
                            <th>User_Id</th>
                            <th>Nombre Obra</th>
                            <th>Autor</th>                                
                            <th>País</th>  
                            <th>Femenino</th>
                            <th>Masculino</th>
                            <th>Otros</th>
                            <th>Descargar</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php        
                        $obra = get_data('nombre_obra');
                        $autor = get_data('autor');
                        $pais = get_data('pais');
                        $femenino = get_data('femenino');
                        $masculino = get_data('masculino');
                        $otro = get_data('otro');
                        $db_connection = get_db_connection();
                        if (($obra == NULL) and ($autor== NULL) and ($pais == NULL) and ($femenino==NULL) and ($masculino == NULL) and ($otro==NULL)){
                                $obras = get_info($db_connection, 'CATEGORIA');
                        }
                        else{
                                $obras = get_obra($db_connection, $obra,$autor,$pais,$femenino,$masculino,$otro);
                        }
                        $db_connection->close(); $db_connection = NULL;
                        generate_html($obras);
                    ?>
                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div>   

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formUsuarios" method=¨post" action="index.php">    
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Nombre de la Obra</label>
                    <input type="text" class="form-control" id="nombre_obra">
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Autor</label>
                    <input type="text" class="form-control" id="autor">
                    </div> 
                    </div>    
                </div>
                <div class="row"> 
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">País</label>
                    <input type="text" class="form-control" id="pais">
                    </div>               
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-lg-3">
                    <div class="form-group">
                    <label for="" class="col-form-label">Femenino</label>
                    <input type="number" class="form-control" id="femenino" min="0" max="10">
                    </div>               
                    </div>
                    <div class="col-lg-3">
                    <div class="form-group">
                    <label for="" class="col-form-label">Masculino</label>
                    <input type="number" class="form-control" id="masculino" min="0" max="10">
                    </div>
                    </div>  
                     <div class="col-lg-3">
                        <div class="form-group">
                        <label for="" class="col-form-label">Otro</label>
                        <input type="number" class="form-control" id="otro" min="0" max="10">
                        </div>
                    </div>  
                </div>              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnBuscar" class="btn btn-dark">Buscar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    
  </body>
</html>
