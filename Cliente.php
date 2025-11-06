<?php

class Cliente
{
    public $nombre;
    private $numero;
    private $soportesAlquilados = [];
    private $numSoportesAlquilados = 0;
    private $maxAlquilerConcurrente;

    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getNumSoportesAlquilados(): int
    {
        return $this->numSoportesAlquilados;
    }

    public function muestraResumen(): void
    {
        echo "<br><b>" . $this->nombre . "</b>";
        echo "<br>Nº de alquileres: " . count($this->soportesAlquilados);
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        return in_array($s, $this->soportesAlquilados);
    }

    public function alquilar(Soporte $s): bool
    {
        if ($this->tieneAlquilado($s)) {
            echo "<br>El cliente ya tiene alquilado el soporte.";
            return false;
        }

        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            echo "<br>Este cliente ha superado el número máximo de alquileres.";
            return false;
        }

        $this->soportesAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        echo "<br>Alquiler realizado con éxito.";
        return true;
    }

    public function devolver(int $numSoporte): bool
    {
        $alquilado = false;
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() == $numSoporte) {
                unset($this->soportesAlquilados[$key]);
                $alquilado = true;
                break;
            }
        }

        if ($alquilado) {
            echo "<br>Devolución realizada con éxito.";
        } else {
            echo "<br>El cliente no tiene alquilado este soporte.";
        }

        return $alquilado;
    }

    public function listarAlquileres(): void
    {
        echo "<br>El cliente " . $this->nombre . " tiene " . count($this->soportesAlquilados) . " soportes alquilados:";
        foreach ($this->soportesAlquilados as $soporte) {
            $soporte->muestraResumen();
        }
    }
}
