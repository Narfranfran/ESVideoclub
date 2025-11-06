<?php
// Videoclub.php
require_once 'Soporte.php';
require_once 'Cliente.php';
require_once 'CintaVideo.php';
require_once 'Dvd.php';
require_once 'Juego.php';

class Videoclub
{
    private $nombre;
    private $productos = [];
    private $numProductos = 0;
    private $socios = [];
    private $numSocios = 0;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    private function incluirProducto(Soporte $producto): void
    {
        $this->productos[] = $producto;
        $this->numProductos++;
    }

    public function incluirCintaVideo(string $titulo, float $precio, int $duracion): void
    {
        $cintaVideo = new CintaVideo($titulo, $this->numProductos + 1, $precio, $duracion);
        $this->incluirProducto($cintaVideo);
    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $formatoPantalla): void
    {
        $dvd = new Dvd($titulo, $this->numProductos + 1, $precio, $idiomas, $formatoPantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minJ, int $maxJ): void
    {
        $juego = new Juego($titulo, $this->numProductos + 1, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
    }

    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes = 3): void
    {
        $socio = new Cliente($nombre, $this->numSocios + 1, $maxAlquileresConcurrentes);
        $this->socios[] = $socio;
        $this->numSocios++;
    }

    public function listarProductos(): void
    {
        echo "<br>Listado de productos:";
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
        }
    }

    public function listarSocios(): void
    {
        echo "<br>Listado de socios:";
        foreach ($this->socios as $socio) {
            $socio->muestraResumen();
        }
    }

    public function alquilarSocioProducto(int $numeroCliente, int $numeroSoporte): void
    {
        $socio = null;
        foreach ($this->socios as $s) {
            if ($s->getNumero() == $numeroCliente) {
                $socio = $s;
                break;
            }
        }

        if ($socio === null) {
            echo "<br>No existe el socio con número " . $numeroCliente;
            return;
        }

        $producto = null;
        foreach ($this->productos as $p) {
            if ($p->getNumero() == $numeroSoporte) {
                $producto = $p;
                break;
            }
        }

        if ($producto === null) {
            echo "<br>No existe el producto con número " . $numeroSoporte;
            return;
        }

        $socio->alquilar($producto);
    }
}