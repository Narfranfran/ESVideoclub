<?php
include_once "Videoclub.php"; // No incluimos nada más

$vc = new Videoclub("Severo 8A");

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es", "16:9");
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en", "16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

//listo los productos 
$vc->listarProductos();

//voy a crear algunos socios 
$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);

echo "<br><br>";

// El socio 2 (Pablo Picasso) alquila el soporte 3 (Torrente)
$vc->alquilarSocioProducto(2, 3);

echo "<br><br>** ";
// El socio 2 (Pablo Picasso) alquila el soporte 4 (Origen)
$vc->alquilarSocioProducto(2, 4);

// El socio 2 intenta alquilar de nuevo el soporte 3 (Torrente)
$vc->alquilarSocioProducto(2, 3);

// El socio 2 intenta alquilar el soporte 6, pero ya ha llegado a su límite de 2
$vc->alquilarSocioProducto(2, 6);

//listo los socios 
$vc->listarSocios();