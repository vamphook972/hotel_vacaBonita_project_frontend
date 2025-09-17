<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $user = $_POST['user'];
    $occupants_number = $_POST['occupants_number'];
    $id_room = $_POST['id_room'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Construir arreglo para enviar al backend
    $data = array(
        "user" => $user,
        "occupants_number" => $occupants_number,
        "id_room" => $id_room,
        "start_date" => $start_date,
        "end_date" => $end_date
    );

    // Convertir a JSON
    $payload = json_encode($data);

    // URL de la API (ajusta el puerto si es diferente)
    $url = "http://localhost:3003/reservations";

    // Inicializar cURL
    $ch = curl_init($url);

    // Configuración de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Ejecutar la petición
    $response = curl_exec($ch);

    // Manejar errores
    if (curl_errno($ch)) {
        echo "Error en la solicitud: " . curl_error($ch);
    } else {
        echo "<pre>Respuesta del servidor: " . $response . "</pre>";
    }

    // Cerrar cURL
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Crear Reserva</h1>
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700">Usuario</label>
                <input type="text" name="user" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Número de Ocupantes</label>
                <input type="number" name="occupants_number" required min="1" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">ID Habitación</label>
                <input type="number" name="id_room" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Inicio</label>
                <input type="date" name="start_date" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Fin</label>
                <input type="date" name="end_date" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 mb-2">Crear Reserva</button>
        </form>
        <!-- Botón para regresar -->
    <div class="mt-4 text-center">
      <a href="cliente.php"
         class="inline-block bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
        ⬅️ Volver
      </a>
    </div>
    </div>
</body>
</html>
