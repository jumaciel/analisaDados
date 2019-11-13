 
function drawChart2(datas) {
    var data = google.visualization.arrayToDataTable([datas]);
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
                datas.push(['Data', 'Umidade', 'Temperatura','Temperatura_2', 'Velocidade do vento'])
                res.forEach(element => { 
                    datas.push([
                        formateData(element.Data),
                        parseFloat(element.Umidade),
                        parseFloat(element.Temperatura),
                        parseFloat(element.Temperatura_2),
                        parseFloat(element.anemometro)
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


                var datas2=[];
                datas2.push(['Data','Temperatura','Velocidade do vento'])
                res.forEach(element => { 
                    datas2.push([
                        formateData(element.Data), 
                        parseFloat(element.Temperatura), 
                        parseFloat(element.anemometro)
                    ])
                } );
                
                var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
                var options = {
                    title: '',
                    hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},
                    vAxis: {minValue: 0}
                };
                var data2 = google.visualization.arrayToDataTable(datas2);
                chart.draw(data2, options);
            }
       })
         e.preventDefault()
        
    })
});