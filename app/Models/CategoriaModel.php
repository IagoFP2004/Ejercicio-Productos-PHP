<?php
declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class CategoriaModel extends BaseDbModel
{
    public function getAllCategorias(){
        $sql = "SELECT * FROM categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}