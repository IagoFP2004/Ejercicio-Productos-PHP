<?php
declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ProductoModel extends BaseDbModel
{
    public const ORDER_COLUMNS = ['producto.codigo', 'producto.nombre', 'producto.coste', 'proveedor.nombre', 'categoria.nombre_categoria'];
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

    public function doFiltros(array $condiciones, int $order){

        $direccion=($order > 0? 'ASC' : 'DESC');
        $order = abs($order);

        $sql = 'SELECT producto.*,categoria.nombre_categoria, proveedor.nombre as nombre_proveedor FROM `producto` LEFT JOIN proveedor ON proveedor.cif = producto.proveedor LEFT JOIN categoria ON categoria.id_categoria = producto.id_categoria';
        $condicionesSQL = $this->filtrado($condiciones);
        if(!empty($condicionesSQL)) {
            $sql .= ' WHERE ' . implode(' AND ', $condicionesSQL);
        }
        $sql.= ' ORDER BY '.self::ORDER_COLUMNS[$order-1].' '.$direccion;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($condiciones);
        return $stmt->fetchAll();
    }

    public function countResults( array $condiciones):int
    {
        $condicionesSQL = $this->filtrado($condiciones);
        $sql ="SELECT COUNT(*) FROM `producto`";
        $stmt = $this->pdo->prepare($sql);
        if(!empty($condicionesSQL)) {
            $sql .= ' WHERE ' . implode(' AND ', $condicionesSQL);
        }
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

}