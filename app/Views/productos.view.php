
<div class="card shadow mb-4">
    <form method="get" action="/productos">
        <input type="hidden" name="order" value="1">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <!--<form action="./?sec=formulario" method="post">                   -->
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label for="alias">Codigo:</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" value="">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label for="nombre_completo">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label for="id_continente">Proovedor:</label>
                        <select name="proveedor" id="proveedor" class="form-control" data-placeholder="Continente">
                            <option value="">-</option>
                            <?php foreach ($proveedores as $proveedor ){?>
                                <option value="<?php echo $proveedor['cif']?>"><?php echo $proveedor['nombre'] ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label for="anho_fundacion">Coste:</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="min_coste" id="min_coste" value="" placeholder="Mí­nimo">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="max_coste" id="max_coste" value="" placeholder="Máximo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label for="id_continente">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-control" data-placeholder="Continente">
                            <option value="">-</option>
                            <?php foreach ($categorias as $categoria){?>
                                <option value="<?php echo $categoria['id_categoria']?>"><?php echo $categoria['nombre_categoria']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12 text-right">
                <a href="/proveedores" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2">
            </div>
        </div>
    </form>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body" id="card_table">
            <div id="button_container" class="mb-3"></div>
            <!--<form action="./?sec=formulario" method="post">                   -->
            <table id="tabladatos" class="table table-striped">
                <thead>
                <tr>
                    <th><a href="<?php echo $_ENV['host.folder'].'productos?'.$url.'&order='.($order ==1 ? '-':'')?>1">Codigo</a></th>
                    <th><a href="<?php echo $_ENV['host.folder'].'productos?'.$url.'&order='.($order ==2 ? '-':'')?>2">Nombre</a> </th>
                    <th><a href="<?php echo $_ENV['host.folder'].'productos?'.$url.'&order='.($order ==3 ? '-':'')?>3">Proovedor</a></th>
                    <th><a href="<?php echo $_ENV['host.folder'].'productos?'.$url.'&order='.($order ==4 ? '-':'')?>4">Coste</a></th>
                    <th><a href="<?php echo $_ENV['host.folder'].'productos?'.$url.'&order='.($order ==5 ? '-':'')?>5">Categoria</a></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto){?>
                        <tr>
                            <td><?php echo $producto['codigo'] ?></td>
                            <td><?php echo $producto['nombre'] ?></td>
                            <td><?php echo $producto['nombre_proveedor'] ?></td>
                            <td><?php echo $producto['coste'] ?></td>
                            <td><?php echo $producto['nombre_categoria'] ?></td>
                        </tr>

                    <?php }?>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav aria-label="Navegacion por paginas">
                <ul class="pagination justify-content-center">
                    <?php if(!$pagina = 1){ ?>
                    <li class="page-item">
                        <a class="page-link" href="/proveedores?page=1&amp;order=1" aria-label="First">
                            <span aria-hidden="true">«</span>
                            <span class="sr-only">First</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="/proveedores?page=2&amp;order=1" aria-label="Previous">
                            <span aria-hidden="true">&lt;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php }?>
                    <li class="page-item active"><a class="page-link" href=""><?php echo $pagina ?></a></li>
                    <?php if($pagina != $max_pagina){ ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo $_ENV['host.folder'].'productos?'.$urlpage?>&page=<?php echo $pagina+1?>" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/proveedores?page=8&amp;order=1" aria-label="Last">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Last</span>
                            </a>
                        </li>
                    <?php }?>
                </ul>
            </nav>
        </div>
    </div>

</div>
