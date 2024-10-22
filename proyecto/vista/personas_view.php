<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Personas</title>
    </head>
    <body>
        <h1>Listado de personas</h1>
        <?php
            foreach ($datos as $dato) {
                echo $dato["id"] . ", " . $dato["nombre"] . "<br/>";
            }
        ?>
    </body>
</html>
