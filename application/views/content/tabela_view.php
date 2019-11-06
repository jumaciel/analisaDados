 
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
 
            <div class="text-center" style="padding:50px; background:white">
               
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
                 <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Temperaturas (Cº)</th>
                            <th scope="col">UR do ar(%)</th>
                            <!--<th scope="col">Velocidade do vento</th>-->
                        </tr>
                    </thead>
                    <tbody id="tabela">
                        <?php foreach($params["dados"] as $key){
                            $date = new DateTime($key["Data"]);
                            print("<tr>");
                            print("<th scope='row'>".$date->format('d/m/Y')."</th>");
                            print("<th scope='row'>".$date->format('H:i:s')."</th>");
                            print("<th>".$key["Temperatura"]."º - ". $key["Temperatura_2"] ."º</th>");
                            print("<th>".$key["Umidade"]."%</th>");
                            //print("<th>".$key["anemometro"]."</th>"); 
                            print("</tr>");
                        }?>
                    </tbody>
                </table>
            </div> 
        </div> 
    </div> 
</div>
     

<script>
window.addEventListener("load", function(event) {
    function formateData(data = null, verificador= false){
        if(data === null) return;
        var dados =  data.split(' ');
        
        if(verificador)
            return dados[1]
        else{
            dados =  dados[0].split('-')
            return dados[2] + "/" + dados[1] +"/"+dados[0]
        }
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
                var html="";
                res = JSON.parse(res)
                res.forEach(element => { 
                    html += ` <tr>
                            <th scope='row'>${formateData(element.Data)}</th>
                            <th scope='row'>${formateData(element.Data,true)}</th>
                            <th>${element.Temperatura}º - ${element.Temperatura_2}º</th>
                            <th>${element.Umidade}%</th>
                        </tr> ` ;
                        console.log(html)
                });
                $("#tabela").html(html);
            }
       })
         e.preventDefault()
        
    })

});

</script>