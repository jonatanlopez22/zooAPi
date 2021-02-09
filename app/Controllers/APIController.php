<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController
{
    protected $modelName = 'App\Models\AnimalModelo';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());

    }

    public function registrarAnimal(){

        $idanimal=$this->request->getPost('idanimal');
        $nombre=$this->request->getPost('nombre');
        $edad=$this->request->getPost('edad');
        $tipo=$this->request->getPost('tipo');
        $descripcion=$this->request->getPost('descripcion');
        $comida=$this->request->getPost('comida');
        

        
        $datosEnvio=array(

            "idanimal"=>$idanimal,
            "nombre"=>$nombre,
            "edad"=>$edad,
            "tipo"=>$tipo,
            "descripcion"=>$descripcion,
            "comida"=>$comida


        );

        if($this->validate('animales')){

            $this->model->insert($datosEnvio);
            $mensaje=array('estado' => true,'mensaje' =>"registro agregado" );

            return $this->respond($datosEnvio);

        }else{

            $validation = \config\services::validation();
            return $this->respond($validation->getErrors(),400);
        }
        
        

    }


    public function editarAnimal($id){

        $datosPeticion=$this->request->getRawInput();

        $nombre=$datosPeticion["nombre"];
        $edad=$datosPeticion["edad"];

        $datosEnvio=array(
            
            "nombre" =>$nombre , 
            "edad"=>$edad
        
        
        );

        
        if($this->validate('animalesPUT')){

            $this->model->update($id,$datosEnvio);
            $mensaje=array('estado' => true,'mensaje' =>"registro editado" );

            return $this->respond($datosEnvio);

        }else{

            $validation = \config\services::validation();
            return $this->respond($validation->getErrors(),400);
        }
        

        return $this->respond($datosEnvio);

    }
    // ...

    public function eliminarAnimal($id){


        $consulta=$this->model->where('idanimal',$id)->delete();
        $filasAfectadas=$consulta->connID->affected_rows;

        if($filasAfectadas==1){

            
            $mensaje=array('estado' => true,'mensaje' =>"registro eliminado" );
            return $this->respond($mensaje);

        }else{

            $mensaje=array('estado' => false,'mensaje' =>"registro no pudo ser encontrado en la bd" );
            return $this->respond($mensaje,400);
        }
        

       
    }

}