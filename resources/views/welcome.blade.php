<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Gráfico de Datos del Sensor</h1>

    <!-- Formulario para ingresar el nombre del sensor -->
    <form id="sensorForm">
        <label for="sensor">Nombre del Sensor:</label>
        <input type="text" id="sensor" name="sensor" placeholder="Escribe el nombre del sensor" required>
        <button type="submit">Generar Gráfico</button>
    </form>

    <canvas id="sensorChart" width="400" height="200"></canvas>

    <script>
        var chart; // Variable global para almacenar la instancia del gráfico

        // Función para generar el gráfico de líneas con Chart.js
        function generateChart(dataLabels, dataValues) {
            var ctx = document.getElementById('sensorChart').getContext('2d');

            // Destruir el gráfico existente antes de crear uno nuevo
            if (chart) {
                chart.destroy();
            }

            // Crear el nuevo gráfico
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dataLabels, // ID en lugar de fechas
                    datasets: [{
                        label: 'Valores del sensor',
                        data: dataValues, // Valores del sensor
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'ID'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Valor'
                            }
                        }
                    }
                }
            });
        }

        // Manejar el envío del formulario con AJAX
        $('#sensorForm').on('submit', function(event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del formulario

            // Obtener el valor del sensor ingresado
            var sensorName = $('#sensor').val();

            // Hacer la solicitud AJAX al endpoint de la API
            $.ajax({
                url: 'https://unreal.eacssolutions.com/api/sensors', // URL del endpoint API
                method: 'GET',
                data: { sensor: sensorName, limit:20 }, // Enviar el nombre del sensor como parámetro
                success: function(response) {
                    // Extraer etiquetas (ID) y valores del JSON devuelto
                    var dataLabels = response.map(function(item) {
                        return item.id; // Usar el ID en lugar de created_at
                    });

                    var dataValues = response.map(function(item) {
                        return item.value;
                    });

                    // Generar el gráfico con los datos obtenidos
                    generateChart(dataLabels, dataValues);
                },
                error: function(error) {
                    console.error("Error obteniendo los datos del sensor:", error);
                }
            });
        });
    </script>
</body>
</html>
