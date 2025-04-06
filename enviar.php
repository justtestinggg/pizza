<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $correo = filter_var(trim($_POST["correo"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["mensaje"]);

    if (empty($nombre) || empty($mensaje) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Completa el formulario correctamente.";
        exit;
    }

    // Cambia este correo por el tuyo
    $destinatario = "contacto@pizzata.cl";
    $asunto = "Nuevo mensaje desde el sitio web";

    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $correo\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $cabeceras = "From: $nombre <$correo>";

    if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
        echo "Mensaje enviado correctamente.";
    } else {
        http_response_code(500);
        echo "Hubo un error al enviar el mensaje.";
    }
} else {
    http_response_code(403);
    echo "Hubo un problema con el envío.";
}
?>
