<?php
require_once 'app/model/model.php';
class proveedoresModel extends Model
{
    
   
    
    public function getProveedores($orderby = false,$direccion= " ASC")
    {
        $query = 'SELECT * FROM proveedores';
        if($orderby){
            switch($orderby){
                case 'nombre':
                    $query .= ' ORDER BY nombre';
                    break;
                case 'cuil_cuit':
                    $query .= ' ORDER BY `cuil_cuit';
                    break;
                case 'ciudad':
                    $query .= ' ORDER BY ciudad';
                    break;
                case 'telefono':
                    $query .= ' ORDER BY telefono';
                    break;
            }
            if($direccion === 'DESC'){
                $query.= ' DESC';
            } else{
                $query.=' ASC';
            }
        }
        
        $sql =  $this->db->prepare($query);
        $sql->execute();
        $proveedores = $sql->fetchAll(PDO::FETCH_OBJ);
        return $proveedores;
    }

    public function getProveedor($id)
    {
        $query = $this->db->prepare('SELECT * FROM proveedores
                                     WHERE id = ?');
        $query->execute([$id]);
        $proveedor = $query->fetch(PDO::FETCH_OBJ);
        return $proveedor;
    }

    public function deteleProveedor($id)
    {
        $query = $this->db->prepare('DELETE FROM proveedores WHERE id = ?');
        $query->execute([$id]);
    }


    public function addProveedores($nombre, $cuil_cuit, $ciudad,$telefono)
    {
        $query = $this->db->prepare('INSERT INTO proveedores(nombre, cuil_cuit, ciudad, telefono) values(?,?,?,?)');
        $query->execute([$nombre, $cuil_cuit, $ciudad, $telefono]);
        $id = $this->db->lastInsertId();
        return $id;
    }
   

    public function updateProveedor($nombre, $cuil_cuit, $ciudad, $telefono, $id)
    {
        $query = $this->db->prepare('UPDATE proveedores SET `nombre` = ?, `cuil_cuit` = ?, `ciudad` = ?, `telefono` = ?
                                     WHERE `id` = ?');
        $query->execute([$nombre, $cuil_cuit, $ciudad, $telefono, $id]);
    }
}