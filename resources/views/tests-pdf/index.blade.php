<!DOCTYPE html>
<html>
<head>
    <title>Export Google Chart to PDF using PHP with DomPDF</title>
{{--    <link rel="stylesheet" href="{!! asset('css/bootstrap3.min.css') !!}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"></head>
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-between">
            <div class="col-4 offset-1">
              <img src="{{ asset('images/logo.png') }}" />
            </div>
            <div class="col-5 mt-4">
              <span>Grupo Fenix</span>
                <br>
              <span>A Solução Definitiva em Pesquisa de Satisfação</span>
                <br>
              <span>Relatório gerado em {{ '22/02/22, às 05:13 UTC' }}CAIO</span>
            </div>
        </div>

        <hr>
    </div>

{{-- gráfico valocimetro --}}
    <div align="center">
        <h4><b>Relatório do dia {{ '21/2/22' }}CAIO</b></h4>
        <p style="margin-right: 46%;">1. Como você avalia o serviço de hoje?</p>
        <canvas id="demo" style="width: 100%; max-width:350px; height: 200px;"></canvas>
        <div hidden id="preview-textfield"></div>
        <h5>Satisfação</h5>
        <h2>{{ '90%' }}CAIO</h2>
    </div>

    <script src="{!! asset('js/gauge.min.js') !!}"></script>
    <script type="text/javascript">
    var opts = {
        angle: -0.0,
        lineWidth: 0.2,
        pointer: {
            length: 0.5,
            strokeWidth: 0.05,
            color: '#000000'
        },
        staticZones: [
            {strokeStyle: "#F03E3E", min: 0, max: 200},
            {strokeStyle: "#F03E3E", min: 200, max: 500},
            {strokeStyle: "#F03E3E", min: 500, max: 1500},
            {strokeStyle: "#FFDD00", min: 1500, max: 2400},
            {strokeStyle: "#30B32D", min: 2400, max: 3000}
        ],
        limitMax: false,
        limitMin: false,
        strokeColor: '#E0E0E0',
        highDpiSupport: true
    };

    var target = document.getElementById('demo');
    var gauge = new Gauge(target).setOptions(opts);

    document.getElementById("preview-textfield").className = "preview-textfield";
    gauge.setTextField(document.getElementById("preview-textfield"));

    gauge.maxValue = 3000;
    gauge.setMinValue(0);
    gauge.set(2650);
    gauge.animationSpeed = 10
</script>
{{-- gráfico valocimetro --}}

{{--  Carinhas ruim regular bom otimo   --}}
    <div align="center">
        <div class="row justify-content-between"
             style="padding: 0px 400px 0px 400px;"
        />
            <div class="col-3">
                <span>{{ '5%' }}CAIO</span>
                <br>
                <img style="width: 45px;" src="{{ asset('images/4.png') }}" />
                <br>
                <span>Ruim</span>
            </div>
            <div class="col-3">
                <span>{{ '5%' }} CAIO</span>
                <br>
                <img style="width: 51px;" src="{{ asset('images/3.png') }}" />
                <br>
                <span>Regular</span>
            </div>
            <div class="col-3">
                <span>{{ '19%' }}CAIO</span>
                <br>
                <img style="width: 50px;" src="{{ asset('images/2.png') }}" />
                <br>
                <span>Bom</span>
            </div>
            <div class="col-3">
                <span>{{ '71%' }}CAIO</span>
                <br>
                <img style="width: 45px;" src="{{ asset('images/1.png') }}" />
                <br>
                <span>Ótimo</span>
            </div>
        </div>
    </div>
{{--  Carinhas ruim regular bom otimo   --}}

{{--  gráfico de linha  --}}
    <div align="center" class="mt-3">
  <canvas id="myChart" style="width: 100%; max-width:800px; height: 50px;"></canvas>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const labels = [
        'Sabado',
        'Domingo',
        'Segunda',
        'Terça',
        'Quarta',
        'Quinta',
        'Sexta',
      ];

      const data = {
        labels: labels,
        datasets: [{
          label: '',
          backgroundColor: 'white',
          borderColor: 'gray',
          data: [15, 10, 23, 17, 27, 31, 21],
        }]
      };

      const config = {
        type: 'line',
        data: data,
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
      };

       const myChart = new Chart(
        document.getElementById('myChart'),
        config
       );
    </script>
{{--  gráfico de linha  --}}

    <div class="container mt-4">
        <hr>
        <h4><strong> Consolidado do dia </strong></h4>
        <p><strong> 1. Como você avalia o serviço de hoje? </strong></p>
    </div>

</body>
</html>
