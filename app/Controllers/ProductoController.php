<?php
declare(strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\CategoriaModel;
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

        $this->view->showViews(
            array('templates/header.view.php', 'productos.view.php', 'templates/footer.view.php'),
            $data
        );
    }
}