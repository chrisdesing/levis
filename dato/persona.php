
<?php
//  TODO:creamos la clase Persona(BASE)
class Persona{
    private $ci;
    private $nombre;
    private $apellidoP;
    private $apellidoM;
    private $telefono;
    private $email;
    private $direccion;
    private $genero;
    
    public function __construct(
        $ci,$nombre,$apellidoP,$apellidoM,$telefono,
        $email,$direccion,$genero
    ) {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->apellidoP = $apellidoP;
        $this->apellidoM = $apellidoM;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->genero = $genero;
    }

    public function getCi()
    {
        return $this->ci;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getApellidoM()
    {
        return $this->apellidoM;
    }

    public function getApellidoP()
    {
        return $this->apellidoP;
    }

    public function getGenero()
    {
        return $this->genero;
    }
}