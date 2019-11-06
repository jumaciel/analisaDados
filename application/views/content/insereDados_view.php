 
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Importação de dados</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Sobre</li>
                    </ol>
                </div> 
            </div> 
            <div class="text-center" style="padding:50px; background:white"> 
                <form id="formulario">
                    <div class="form-group">
                        <label for="exampleFormControlFile1" >Local da base de dados:</label><br/>
                        <select class="form-control" id="idLocal"> 
                           <?php foreach ($params["municipio"] as $key) {
                               print("<option value='".$key["idLocal"]."'>".$key["endereco"].", " . $key["cidade"] . " - ". $key["estado"] . "</option>");
                           }?>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="exampleFormControlFile1" >Insira o arquivo .txt de dados: </label><br/>
                        <input type="file" name="log" class="form-control-file" id="log">
                    </div> 
                    <button type="submit" style="background:rgb(2, 114, 17); border:none; padding:10px" class="btn btn-primary"><b>Salvar</b></button>
                </form>
            </div> 
        </div> 
    </div> 
</div>
     
<style>
label {
    display: flex !important;
}
</style>


<script>
    window.addEventListener("load", function(event) {
 
    $("#formulario").submit(function(e) {
        
        e.preventDefault();
   
        var dados = {};
        var form = $(this).serializeArray()

        var form_data = new FormData();
        for(let i = 0; i <$(this).find('[name="log"]').prop('files').length; i++){
            form_data.append('log', $(this).find('[name="log"]').prop('files')[i]);
        }
        
        for (var i in form) {
            var f = form[i].name,
                v = form[i].value;
            if (v != '' && f != '') {
                dados[f] = v;
            }
        }

        form_data.append('dados',JSON.stringify(dados)) 
        form_data.append('idLocal', $("#idLocal").val())
         
        $.ajax({
            url: '/home/upload',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res){ 
                console.log(res)
                alert("Arquivos upados com sucesso!");
            },
            error:function(e){ 
                console.log('ERROR',e)
            }
        }) 

    });
});
</script>