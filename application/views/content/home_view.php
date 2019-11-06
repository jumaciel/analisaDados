 
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Analises Gerais</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Sobre</li>
                    </ol>
                </div>

            </div>
            <div class="text-center" style="padding:50px">
            <form class="forms">
                    <div class="container">
                        <div class="row" style="display: inline-flex;">
                            <div class="col-sm" style="margin-left:-180px; margin-right:20px">
                                <div class="form-group">
                                    <label for="dataIni" style="float:left" >Pesquisa</label>
                                    <div class="form-group" style="width:350px"> 
                                        <select class="form-control" id="idLocal"> 
                                        <?php foreach ($params["municipio"] as $key) {
                                            print("<option value='".$key["idLocal"]."'>".$key["endereco"].", " . $key["cidade"] . " - ". $key["estado"] . "</option>");
                                        }?>
                                    </select>
                                </div> 
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="dataIni" style="float:left" >Data Inicio</label>
                                    <input type="date" class="form-control" id="dataIni" aria-describedby="emailHelp" placeholder="Data inicio" required>
                                </div>
                            </div>
                            <div class="col-sm" style="margin-left:20px">
                                <div class="form-group">
                                    <label for="datafim"  style="float:left">Data Fim</label>
                                    <input type="date" class="form-control"   id="datafim" aria-describedby="emailHelp" placeholder="Data fim" >
                                </div>
                            </div>
                             
                            <div> 
                                <button type="submit" id="pesquisa" style="margin-top:27px; margin-left:10px" class="btn btn-success">Pesquisa</button>
                            </div>
                        </div>
                    </div>
                    </form>
                <div id="chart_div" style="width: 100%; height: 500px;"></div>
            </div> 
        </div> 
    </div> 
</div>
     

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    var datas= [
            ['Data', 'Umidade', 'Temperatura','Temperatura_2'],
            <?php 
                foreach ($params["dados"] as $key) {
                    echo("['". date_format(date_create($key["Data"]),"d/m/y - H:i")  ."',". $key["Umidade"] .",". $key["Temperatura"] .",". $key["Temperatura_2"] ."],\n");
                }
                
            ?>
        ];
        console.log(datas)
    function drawChart() {
        var data = google.visualization.arrayToDataTable(datas);

        var options = {
            title: '',
            hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


<script> 
function drawChart2(datas) {
    var data = google.visualization.arrayToDataTable([
        
        datas
    ]);

    var options = {
        title: '',
        hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
window.addEventListener("load", function(event) {
    function formateData(data = null, verificador= false){
        if(data === null) return;
        var dados =  data.split(' ');
         
        hora  =  dados[1].split(":");
        dados =  dados[0].split('-')
        return dados[2] + "/" + dados[1] +"/"+dados[0] + " - " + hora[0]+":"+hora[1]
         
    }
    $(".forms").submit(function(e){  
       
       //filtroTabela
       $.ajax({
            url: '/home/filtroTabela',
            type: 'POST',
            async:false,
            data: {
                dataIni: $("#dataIni").val(),
                dataFim: $("#datafim").val(),
                idLocal:  $("#idLocal").val()
            },
            success: function(res){  
                var datas=[];
                res = JSON.parse(res)
                datas.push(['Data', 'Umidade', 'Temperatura','Temperatura_2'])
                res.forEach(element => { 
                    datas.push([
                        formateData(element.Data),
                        parseFloat(element.Umidade),
                        parseFloat(element.Temperatura),
                        parseFloat(element.Temperatura_2)
                    ])
                } );
                
                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                var options = {
                    title: '',
                    hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},
                    vAxis: {minValue: 0}
                };
                var data = google.visualization.arrayToDataTable(datas);
                chart.draw(data, options);
            }
       })
         e.preventDefault()
        
    })

});

</script>