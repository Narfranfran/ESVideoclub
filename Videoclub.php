<?php
// Videoclub.php
require_once 'Soporte.php';
require_once 'Cliente.php';
require_once 'CintaVideo.php';
require_once 'Dvd.php';
require_once 'Juego.php';

class Videoclub {
    /** @var Soporte[] */
    protected array $productos = [];
    /** @var Cliente[] */
    protected array $socios = [];

    // Métodos públicos para crear e incluir productos
    public function incluirCintaVideo(string $titulo, int $numRegistro, float $precio, int $duracion): CintaVideo {
        $c = new CintaVideo($titulo, $numRegistro, $precio, $duracion);
        $this->incluirProducto($c);
        return $c;
    }

    public function incluirDvd(string $titulo, int $numRegistro, float $precio, array $idiomas = [], string $formatoPantalla = '16:9'): Dvd {
        $d = new Dvd($titulo, $numRegistro, $precio, $idiomas, $formatoPantalla);
        $this->incluirProducto($d);
        return $d;
    }

    public function incluirJuego(string $titulo, int $numRegistro, float $precio, string $consola, int $minJugadores = 1, int $maxJugadores = 1): Juego {
        $j = new Juego($titulo, $numRegistro, $precio, $consola, $minJugadores, $maxJugadores);
        $this->incluirProducto($j);
        return $j;
    }

    public function incluirCliente(string $nombre, int $numero, int $maxAlquilerConcurrente = 3): Cliente {
        $c = new Cliente($nombre, $numero, $maxAlquilerConcurrente);
        $this->socios[] = $c;
        return $c;
    }

    // Operación privada para introducir un producto en el array
    private function incluirProducto(Soporte $s): void {
        $this->productos[] = $s;
    }

    // Buscar productos o clientes por número de registro / número de socio
    public function buscarProductoPorRegistro(int $numRegistro): ?Soporte {
        foreach ($this->productos as $p) {
            if ($p->getNumRegistro() === $numRegistro) return $p;
        }
        return null;
    }

    public function buscarClientePorNumero(int $numero): ?Cliente {
        foreach ($this->socios as $s) {
            if ($s->getNumero() === $numero) return $s;
        }
        return null;
    }

    // listar resumenes (implementando polimorfismo Resumible)
    public function listarProductos(): void {
        echo "Listado de productos del videoclub:\n";
        foreach ($this->productos as $p) {
            $p->muestraResumen();
            echo "--------------------------\n";
        }
    }

    public function listarSocios(): void {
        echo "Listado de socios del videoclub:\n";
        foreach ($this->socios as $s) {
            $s->muestraResumen();
            echo "--------------------------\n";
        }
    }
}