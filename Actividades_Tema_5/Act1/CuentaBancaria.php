<?php
class CuentaBancaria{
    private $usuario;
    private $pin;
    private $entradas;
    private $salidas;
    private $saldo;

    // Constructor
    public function __construct($usuario, $pin){
        $this->usuario = $usuario;
        $this->pin = $pin;
        $this->entradas = [];
        $this->salidas = [];
        $this->saldo = 0;
    }

    // Cambiar pin
    public function cambia_pin($nuevoPin){
        $this->pin = $nuevoPin;
    }

    // Validar usuario
    public function validarUsuario($usuario, $pin){
        return ($this->usuario === $usuario && $this->pin === $pin);
    }

    // Ingresar dinero
    public function ingresar($cantidad){
        $this->entradas[] = $cantidad;
        $this->saldo += $cantidad;
    }

    // Sacar dinero
    public function sacar($cantidad){
        if($cantidad > $this->saldo){
            return false;
        } else {
            $this->salidas[] = $cantidad;
            $this->saldo -= $cantidad;
            return true;
        }
    }

    // Getters
    public function getSaldo(){
        return $this->saldo;
    }

    public function getEntradas(){
        return $this->entradas;
    }

    public function getSalidas(){
        return $this->salidas;
    }

    public function __destruct(){
        echo "<br>Cuenta de {$this->usuario} cerrada.</br>";
    }
}

// Ejemplo
$cuenta = new CuentaBancaria("Fidel", "1234");

// Validar usuario
if($cuenta->validarUsuario("Fidel", "1234")){
    echo "Usuario válido<br>";

    // Ingresar 100€
    $cuenta->ingresar(100);
    echo "Se han ingresado 100 euros. Saldo actual: " . $cuenta->getSaldo() . "€<br>";

    // Sacar 80€
    $gasto = 80;
    if($cuenta->sacar($gasto)){
        echo "Se han retirado 80 euros. Saldo actual: " . $cuenta->getSaldo() . "€<br>";

        // Mostrar historial
        echo "<h1>Listado de entradas:</h1>";
        foreach($cuenta->getEntradas() as $entrada){
            echo "Entrada: {$entrada}<br>";
        }

        echo "<h1>Listado de salidas:</h1>";
        foreach($cuenta->getSalidas() as $salida){
            echo "Salida: {$salida}<br>";
        }

    } else {
        echo "Fondos insuficientes para retirar {$gasto}€.<br>";
    }

} else {
    echo "Usuario no válido<br>";
}
?>
