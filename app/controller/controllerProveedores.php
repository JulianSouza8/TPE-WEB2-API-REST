<?php
    require_once "./app/model/proveedoresModel.php";
    require_once "./app/view/json.view.php";




    class controllerProveedores{
        
        private $view;
        private $model;
        

        public function __construct(){
            $this->view = new JSONView();
            $this->model = new proveedoresModel();
            
        }

        public function getProveedores($req, $res)
    {
        $orderby = false;
        $direccion = null;
        if(isset($req->query->orderby)){
            $orderby = $req->query->orderby;
            if(isset($req->query->direccion)){
               $direccion = $req->query->direccion;
            }
        }
        $proveedores = $this->model->getProveedores($orderby,$direccion);
        return $this->view->response($proveedores);
    }

    public function getProveedor($req, $res)
    {
        $id = $req->params->id;
        $proveedor = $this->model->getProveedor($id);
        return $this->view->response($proveedor);
    }

    public function deleteProveedor($req,$res){
        $id = $req->params->id;
        $proveedor = $this->model->getProveedor($id);
        if (!$proveedor) {
            return $this->view->response("El proveedor que se intento eliminar con el id=$id no existe", 404);
        }
        try{
            $proveedor = $this->model->deteleProveedor($id);
        }
        catch (Exception $e) {
            return $this->view->response("No se pudo eliminar el proveedor con el id=$id porque esta vinculado con un producto", 401);   // validar codigo de error
        }
        $this->view->response("El proveedor con el id=$id se eliminó correctamente", 200);

    }

    public function addProveedor($req,$res){
        if (empty($req->body->nombre)  || empty($req->body->cuil_cuit) || empty($req->body->ciudad) || empty($req->body->telefono)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $cuil_cuit = $req->body->cuil_cuit;
        $ciudad = $req->body->ciudad;
        $telefono = $req->body->telefono;
        

        $id = $this->model->addProveedores($nombre, $cuil_cuit, $ciudad, $telefono);
        if (!$id) {
            return $this->view->response("Error al agregar proveedor", 500);
        }

        $proveedor = $this->model->getProveedor($id);
        return $this->view->response($proveedor, 201);
    }

    public function updateProveedor($req,$res){
            $id = $req->params->id;
            $producto = $this->model->getProveedor($id);

            if (!$producto) {
                return $this->view->response("El proveedor con el id=$id no se puede modificar porque no existe.", 404);
            }
            if (empty($req->body->nombre)  || empty($req->body->cuil_cuit) || empty($req->body->ciudad) || empty($req->body->telefono)) {
                return $this->view->response('Faltan completar datos', 400);
            }

            $nombre = $req->body->nombre;
            $cuil_cuit = $req->body->cuil_cuit;
            $ciudad = $req->body->ciudad;
            $telefono = $req->body->telefono;

            $this->model->updateProveedor($nombre, $cuil_cuit, $ciudad, $telefono,$id);

            // obtengo la tarea modificada y la devuelvo en la respuesta
            $proveedor = $this->model->getProveedor($id);
            $this->view->response($proveedor, 200);
    }

    }