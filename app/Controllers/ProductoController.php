<?php
declare(strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\CategoriaModel;
use Com\Daw2\Models\ProductoModel;
use Com\Daw2\Models\ProveedorModel;

class ProductoController extends BaseController
{
    public function showView()
    {
        $data = [
            'titulo' => 'Listado Productos',
            'breadcrumb' => ['Productos', 'Listado de productos'],
        ];

        $proveedorModel = new ProveedorModel();
        $data['proveedores']=$proveedorModel->getAllProveedores();

        $categoriaModel = new CategoriaModel();
        $data['categorias']=$categoriaModel->getAllCategorias();

        $productoModel = new ProductoModel();
        $data['productos'] = $productoModel->getListado();

        $condiciones = [];

        if(!empty($_GET['codigo'])){
            $condiciones['codigo'] = '%'.$_GET['codigo'].'%';
        }
        if(!empty($_GET['nombre'])){
            $condiciones['nombre'] = '%'.$_GET['nombre'].'%';
        }
        if(!empty($_GET['categoria'])){
            $condiciones['categoria'] = $_GET['categoria'];
        }
        if(!empty($_GET['proveedor'])){
            $condiciones['proveedor'] = $_GET['proveedor'];
        }
        if(!empty($_GET['min_coste'])){
            $condiciones['min_coste'] = $_GET['min_coste'];
        }
        if(!empty($_GET['max_coste'])) {
            $condiciones['max_coste'] = $_GET['max_coste'];
        }
        $data['productos'] = $productoModel->doFiltros($condiciones);



        $this->view->showViews(
            array('templates/header.view.php', 'productos.view.php', 'templates/footer.view.php'),
            $data
        );
    }


}