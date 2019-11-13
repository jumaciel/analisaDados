 
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Endereco</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Pais</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Observacao</th>
                            <th scope="col">Altura</th>
                            <th scope="col">Ação</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($params["municipio"] as $key) {  
                            print("<tr>");
                            print("<th scope='row'>".$key["endereco"]."</th>");
                            print("<th scope='row'>".$key["cidade"]."</th>"); 
                            print("<th scope='row'>".$key["estado"]."</th>"); 
                            print("<th scope='row'>".$key["pais"]."</th>"); 
                            print("<th scope='row'>".$key["longitude"]."</th>"); 
                            print("<th scope='row'>".$key["latitude"]."</th>"); 
                            print("<th scope='row'>".$key["observacao"]."</th>"); 
                            print("<th scope='row'>".$key["altura"]."</th>"); 
                            print('<th scope="row"><button type="button" data-id="'.$key["idLocal"].'" class="btn btn-danger deletarMunicipio">Deletar</button></th>'); 
                            print("</tr>");
                        }?>
                    </tbody>
                </table>
                <button type="button"  id="datasssnovo" class="btn btn-success">Novo</button>
            </div>
            <br><br>
            <div class="text-center"  id="sadasd" style="padding:50px; background:white; display:none"> 
                <form id="formulario">
                <div class="form-group">
                        <label for="formGroupExampleInput">Cidade</label>
                        <input type="text" class="form-control" id="cidade" placeholder="Cidade..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Estado</label>
                        <input type="text" class="form-control" id="estado" placeholder="Estado..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Pais</label>
                        <input type="text" class="form-control" id="pais" placeholder="Pais..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Rua</label>
                        <input type="text" class="form-control" id="endereco" placeholder="Logradouro..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Longitude</label>
                        <input type="text" class="form-control" id="longitude" placeholder="Longitude..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Latitude</label>
                        <input type="text" class="form-control" id="latitude" placeholder="Latitude..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Observacao</label>
                        <input type="text" class="form-control" id="observacao" placeholder="Observacao..." required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Altura</label>
                        <input type="text" class="form-control" id="altura" placeholder="Altura..." required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
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
 
<script src="/assets/js/localizacao.js"></script>