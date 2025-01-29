<?php
declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ProductoModel extends BaseDbModel
{
    public function getListado(){
        $sql = 'SELECT producto.*,categoria.nombre_categoria, proveedor.nombre as nombre_proveedor FROM `producto` LEFT JOIN proveedor ON proveedor.cif = producto.proveedor LEFT JOIN categoria ON categoria.id_categoria = producto.id_categoria; ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function filtrado(array $condiciones):array
    {
        $filtros = [];

        if(isset($condiciones['codigo'])){
            $filtros['codigo'] = 'producto.codigo LIKE :codigo';
        }
        if(isset($condiciones['nombre'])){
            $filtros['nombre'] = 'producto.nombre LIKE :nombre';
        }
        if(isset($condiciones['proveedor'])){
            $filtros['proveedor'] = 'producto.proveedor LIKE :proveedor';
        }
        if(isset($condiciones['categoria'])){
            $filtros['categoria'] = 'producto.id_categoria LIKE :categoria';
        }
        if (isset($condiciones['max_coste'])){
            $filtros['max_coste'] = 'producto.coste <= :max_coste';
        }
        if (isset($condiciones['min_coste'])){
            $filtros['min_coste'] = 'producto.coste >= :min_coste';
        }
        return $filtros;
    }

    public function doFiltros(array $condiciones){
        $sql = 'SELECT producto.*,categoria.nombre_categoria, proveedor.nombre as nombre_proveedor FROM `producto` LEFT JOIN proveedor ON proveedor.cif = producto.proveedor LEFT JOIN categoria ON categoria.id_categoria = producto.id_categoria';
        $condicionesSQL = $this->filtrado($condiciones);

        if(!empty($condicionesSQL)) {
            $sql .= ' WHERE ' . implode(' AND ', $condicionesSQL);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($condiciones);
        return $stmt->fetchAll();
    }
}