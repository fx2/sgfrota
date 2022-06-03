<!DOCTYPE html>
        <html>
            <head>
                <title>Export Google Chart to PDF using PHP with DomPDF</title>
          <link rel="stylesheet" href="{!! asset('css/bootstrap3.min.css') !!}">

            </head>
            <body>
                <br /><br />
                <div class="container" id="testing">
                    <h3 align="center">Export Google Chart to PDF using PHP with DomPDF</h3>
                    <br />
           <div class="panel panel-default">
            <div class="panel-heading">
             <h3 class="panel-title">Export Google Chart to PDF using PHP with DomPDF</h3>
            </div>
            <div class="panel-body" align="center">
                <canvas id="demo"  style="width: 50%; max-width:100px; height: 40px; "></canvas>
                <div id="preview-textfield"></div>
            </div>
           </div>
                </div>
          <br />
          <div align="center">
           <form method="get" id="make_pdf" action="/download">
               {{csrf_field()}}
            <input type="hidden" name="hidden_html" id="hidden_html" />
            <button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs">Make PDF</button>
           </form>
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
            gauge.set(2250);


            gauge.animationSpeed = 30


        </script>
            </body>
        </html>

        <script>

        </script>
