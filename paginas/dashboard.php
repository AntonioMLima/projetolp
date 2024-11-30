<?php
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
?>

<main class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mb-4">Dashboard - Sistema de Estacionamento</h2>

            <!-- Card com gráfico -->
           

            <!-- Seção para status do estacionamento (por exemplo, vagas ocupadas e disponíveis) -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-white bg-success mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Vagas Disponíveis</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">120</h3>
                            <p class="card-text">Número de vagas disponíveis para novos veículos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-white bg-danger mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Vagas Ocupadas</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">50</h3>
                            <p class="card-text">Número de vagas já ocupadas no estacionamento.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção de estatísticas -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Total de Veículos Estacionados</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">170</h3>
                            <p class="card-text">Total de veículos estacionados no momento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">Veículos por Tipo</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Carros: 120</li>
                                <li>Motos: 40</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">Última Entrada</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Carro - Placa XYZ1234</h4>
                            <p class="card-text">Último veículo a estacionar no sistema.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusão da biblioteca Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Carregar a biblioteca do Google Charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Array de dados que será usado no gráfico
            var data = google.visualization.arrayToDataTable([
                ['Produto', 'Estoque Comprado'],
                ['Tênis', 10],
                ['Camiseta', 30],
                ['Short', 25],
                ['Meia', 5],
            ]);

            // Opções de customização do gráfico
            var options = {
                title: 'Estoque de Produtos Comprados',
                hAxis: {title: 'Produtos',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0},
                chartArea: {width: '70%', height: '70%'}
            };

            // Renderizar o gráfico na div com id 'chart_div'
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</main>

<?php require_once 'rodape.php'; ?>
