<?php
require_once 'choferes.php';
class choferPDO
{
    private $configuracion = [
        'servidor' => 'localhost',
        'usuario' => 'root',
        'password' => '',
        'baseDatos' =>'camiones'


    ];

    public function __construct()
    {
        try{
            $this->pdo = new PDO(
                "mysql:host={$this->configuracion['servidor']};
                 dbname={$this->configuracion['baseDatos']};charset=utf8",
                 $this->configuracion['usuario'],
                 $this->configuracion['password']
             );
        }
        catch(PDOexception $e){
            die("¡error!". $e-getmessage() . "<br>");
        }

    }
    public function insert($c){
        $cuil = $c->getCuil();
        $insercion = $this->pdo->prepare("SELECT Cuil FROM chofer where Cuil = '$cuil'");
        $insercion->execute();
        if( $insercion->fetch(PDO::FETCH_OBJ))
        {
            header("Location: ../chofer.php?mensaje=2");
                die();
        }
        else
        {
            $insercion = $this->pdo->prepare("INSERT INTO chofer (Cuil, Nombre, Apellido, Telefono, Vencimiento_Psicofisico, 
            Vencimiento_Cargas_Peligrosas, Vencimiento_Art, Vencimiento_Manip_Alimentos) VALUES (?,?,?,?,?,?,?,?)");

            $datos = [
                $c->getCuil(),
                $c->getNombre(),
                $c->getApellido(),
                $c->getTelefono(),
                $c->getPsico(),
                $c->getCargas(),
                $c->getArt(),
                $c->getCeda()
            ];

            if($insercion-> execute($datos))
            {
                header("Location: ../chofer.php?mensaje=1");
                die();
            }
        }
    }
    public function update($c){

        $id= $this->getidc($c);
        $n = $c->getNombre();
        $a = $c->getApellido();
        $t = $c->getTelefono();
        $ps = $c->getPsico();
        $ca = $c->getCargas();
        $ar = $c->getArt();
        $ce = $c->getCeda();
        $insercion = $this->pdo->prepare("UPDATE chofer SET Nombre = '$n', Apellido ='$a', Telefono='$t', Vencimiento_Psicofisico='$ps', 
        Vencimiento_Cargas_Peligrosas='$ca', Vencimiento_Art='$ar', Vencimiento_Manip_Alimentos='$ce'  WHERE ID_Chofer = $id");
        
        if($insercion-> execute($datos))
        {
            header("Location: ../chofer.php?mensaje=1");
            die();
        }
        else{
            echo "murio";
        }
    }

    public function getAll(){
        $insercion = $this->pdo->prepare("SELECT ID_Chofer ,Cuil, Nombre, Apellido, Telefono, Vencimiento_Psicofisico, 
        Vencimiento_Cargas_Peligrosas, Vencimiento_Art, Vencimiento_Manip_Alimentos FROM chofer");
        $insercion->execute();
        while ($result = $insercion->fetch(PDO::FETCH_OBJ))
        {
            $c= new chofer($result->ID_Chofer,$result->Cuil,$result->Nombre,$result->Apellido,$result->Telefono,$result->Vencimiento_Psicofisico,$result->Vencimiento_Cargas_Peligrosas,$result->Vencimiento_Art,$result->Vencimiento_Manip_Alimentos);
            $chofer[]=$c;
        }
        if(empty($chofer)){
            $chofer = 1;
            return $chofer;
        }
        else{
        return $chofer;
        }
    }

    public function getVencimientos(){
        $choferes= $this->getAll();
        $hoy = date_create(date("l"));
        if($choferes == 1){
            return $choferes;
        }
        else{
            foreach($choferes as $chofer){
                $psico = date_diff(date_create($chofer->getPsico()),$hoy);
                $cargas=date_diff(date_create($chofer->getCargas()),$hoy);
                $art=date_diff(date_create($chofer->getArt()),$hoy);
                $ceda=date_diff(date_create($chofer->getCeda()),$hoy);
                if($psico->format('%a') <30 or $cargas->format('%a') < 30 or $art->format('%a')< 30 or $ceda->format('%a')< 30 ){
                    $choferesven[]=$chofer;
                }
                
            }
            return $choferesven;
        }
    }

    private function getidc($c){
        $cuil = $c->getCuil();
        $insercion = $this->pdo->prepare("SELECT ID_Chofer FROM chofer where cuil ='$cuil'");
            $insercion->execute();
            if($result = $insercion->fetch(PDO::FETCH_OBJ))
            {
               return $result->ID_Chofer;

            }
    }

    public function getById($id){
        $insercion = $this->pdo->prepare("SELECT ID_Chofer ,Cuil, Nombre, Apellido, Telefono, Vencimiento_Psicofisico, 
        Vencimiento_Cargas_Peligrosas, Vencimiento_Art, Vencimiento_Manip_Alimentos FROM chofer where ID_Chofer=$id");
        $insercion->execute();
        while ($result = $insercion->fetch(PDO::FETCH_OBJ))
        {
            $c= new chofer($result->ID_Chofer,$result->Cuil,$result->Nombre,$result->Apellido,$result->Telefono,$result->Vencimiento_Psicofisico,$result->Vencimiento_Cargas_Peligrosas,$result->Vencimiento_Art,$result->Vencimiento_Manip_Alimentos);
        }
        return $c;
    }

}

?>