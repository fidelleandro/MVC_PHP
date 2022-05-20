<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de productos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <br>
    <!-- Button trigger modal --> 
    <button type="button" onclick="add()" class="btn btn-primary" data-toggle="modal" data-target="#registroProductoModal">
        Agregar producto
    </button>
<!-- Modal -->
    <div class="modal fade" id="registroProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gestión de producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="agregarProducto.php">
                        <input type="hidden" id="producto_id" name="producto_id" value="">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre de producto"> 
                        </div> 
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" min="0" id="precio" name="precio" placeholder="Ingrese precio deL producto"> 
                        </div> 
                        <div class="mb-3">
                            <label for="stock" class="form-label">stock</label>
                            <input type="number" class="form-control" min="0" id="stock" name="stock" placeholder="Ingrese stock de producto"> 
                        </div> 
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label> 
                            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripción"></textarea>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="agregar(this)" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <table id="reporte_productos" class="">
        <thead>
            <th>Nª</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php 
                include 'System/MYSQL.php';
                $mysql = new MYSQL('localhost','root','','tienda_ciclo2');
                
                $reporte = $mysql->reporte('producto','id,nombre,precio,stock,descripcion');
            ?>
            <?php  
            foreach ($reporte as $key => $producto) {
               echo '<tr>';
                 echo '<td class="id_p" data-id="'.$producto['id'].'"></td>';
                 echo '<td>'.$producto['nombre'].'</td>';
                 echo '<td>'.$producto['precio'].'</td>';
                 echo '<td>'.$producto['stock'].'</td>';
                 echo '<td>'.$producto['descripcion'].'</td>';
                 echo '<td>';
                 echo   '<button class="btn btn-primary" onclick="editar('.$producto['id'].')">Editar</button>';
                 echo   '<button class="btn btn-danger" onclick="eliminar(this,'.$producto['id'].')">Eliminar</button>';
                 echo '</td>';
               echo '</tr>';
            } 
            ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
        //$(document).ready( function () {
           reporte = $('#reporte_productos').DataTable();
        //});
        function add(){
            $('#producto_id').val('');
            $('#registroProductoModal form')[0].reset();
        }
        function editar(id){ 
            $('#producto_id').val(id); 
            $.ajax({
                url: 'CargarProducto.php',
                type: 'POST', 
                dataType: 'json',
                data: {id:id},
                success: function (response){
                    console.log(response);
                    $('#nombre').val(response.datos.nombre); 
                    $('#precio').val(response.datos.precio); 
                    $('#stock').val(response.datos.stock);
                    $('#descripcion').val(response.datos.descripcion); 
                    $('#registroProductoModal').modal('show')
                }
            });
        } 
        function agregar(THIS){  
            $.ajax({
                url: 'agregarProducto.php',
                type: 'POST', 
                dataType: 'json',
                data: $('#registroProductoModal form').serialize(),
                success: function (response){
                    if (response.status) { //Si todo es correcto, hacer
                        // tr = '<tr>';
                        //     tr += '<td class="id_p" data-id="'+response.data['id']+'"></td>';
                        //     tr += '<td>'+response.data['nombre']+'</td>';
                        //     tr += '<td>'+response.data['precio']+'</td>';
                        //     tr += '<td>'+response.data['stock']+'</td>';
                        //     tr += '<td>'+response.data['descripcion']+'</td>';
                        //     tr += '<td>';
                        //     tr +=   '<button class="btn btn-primary" onclick="editar('+response.data['id']+')">Editar</button>';
                        //     tr +=   '<button class="btn btn-danger" onclick="eliminar(this,'+response.data['id']+')">Eliminar</button>';
                        //     tr += '</td>';
                        // tr += '</tr>';
                        // $('#reporte_productos tbody').prepend(tr);
                        alert(response.message);
                        $('#registroProductoModal').modal('hide');
                    }
                    else{ //si es incorrecto mostrar
                          alert(response.message);
                    }
                }
            });
        }
        function eliminar(THIS,id){
                        swal({
                                title: "Desea eliminar el producto?",
                                text: "El producto será eliminado para siempre!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                                })
                                .then((willDelete) => {
                                if (willDelete) {
                                    swal("Listo! el producto fue eliminado!", {
                                    icon: "success",
                                    });
                                    $.ajax({
                                            url: 'eliminar.php',
                                            type: 'POST',
                                            data: {idproducto:id},
                                            success: function (response){
                                                
                                            }
                                     }); 
                                } else {
                                    swal("El producto no fue eliminado!");
                                }
                            });
            
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>