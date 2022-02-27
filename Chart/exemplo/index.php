<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>


</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                    var nomes = [];
                    var chamados = [];
                    var finalizados = [];
                    var dia = '';

                    for (var i in data) {
                        nomes.push(data[i].Atendente );
                        chamados.push(data[i].Total_Atendente );
                        finalizados.push(data[i].Total_Finalizados );
                        dia = data[i].Data_Atendimento;
                    }

                    console.log( nomes );
                    console.log( chamados );
                    console.log( finalizados );

                    var chartdata = {
                        labels: nomes ,
                        datasets: [
                            {
                                label: 'Totais de Chamados ' + dia ,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: [chamados , finalizados] 
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>

</body>
</html>