<?php
// Cliente.php
require_once 'Soporte.php';

class Cliente {
    protected string $nombre;
    protected int $numero;
    protected int $maxAlquilerConcurrente;
    protected int $numSoportesAlquilados = 0; // contador total de alquileres realizados
    /** @var Soporte[] */
    protected array $soportesAlquilados = [];

    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente = 3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    // getter/setter numero
    public function getNumero(): int {
        return $this->numero;
    }
    public function setNumero(int $numero): void {
        $this->numero = $numero;
    }

    // getter numSoportesAlquilados (contador total)
    public function getNumSoportesAlquilados(): int {
        return $this->numSoportesAlquilados;
    }

    public function muestraResumen(): void {
        $actuales = count($this->soportesAlquilados);
        echo "Cliente: {$this->nombre} (Número: {$this->numero}) - Alquileres actuales: {$actuales}\n";
    }

    public function tieneAlquilado(Soporte $s): bool {
        foreach ($this->soportesAlquilados as $soporte) {
            if ($soporte->getNumRegistro() === $s->getNumRegistro()) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s): bool {
        if ($s->estaAlquilado()) {
            echo "No se puede alquilar '{$s->getTitulo()}' (registro {$s->getNumRegistro()}): ya está alquilado.\n";
            return false;
        }
        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            echo "No se puede alquilar '{$s->getTitulo()}': máximo de alquileres concurrentes ({$this->maxAlquilerConcurrente}) alcanzado.\n";
            return false;
        }
        // Alquilamos
        $s->setAlquilado(true);
        $this->soportesAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        echo "Alquilado correctamente: '{$s->getTitulo()}' (registro {$s->getNumRegistro()}).\n";
        return true;
    }

    public function devolver(int $numSoporte): bool {
        foreach ($this->soportesAlquilados as $idx => $soporte) {
            if ($soporte->getNumRegistro() === $numSoporte) {
                $soporte->setAlquilado(false);
                unset($this->soportesAlquilados[$idx]);
                // reindex array
                $this->soportesAlquilados = array_values($this->soportesAlquilados);
                echo "Devolución realizada: '{$soporte->getTitulo()}' (registro {$numSoporte}).\n";
                return true;
            }
        }
        echo "No se puede devolver: no figura el soporte con registro {$numSoporte} entre los alquileres del cliente.\n";
        return false;
    }

    public function listarAlquileres(): void {
        $num = count($this->soportesAlquilados);
        echo "El cliente '{$this->nombre}' tiene actualmente {$num} alquiler(es):\n";
        if ($num === 0) {
            echo "  (ninguno)\n";
            return;
        }
        foreach ($this->soportesAlquilados as $s) {
            echo "  - {$s->getTitulo()} (registro {$s->getNumRegistro()})\n";
        }
    }
}