
window.addEventListener("load", function(event) {
 
    $(".deletarMunicipio").click(function(e){ 
        e.preventDefault();
        if(confirm("Deseja apagar todos os dados deste local?")){
            $.ajax({
                url: '/home/apagar_dados',
                type: 'GET',
                data: { idLocal: $(this).attr("data-id") },
                success: function(res){ 
                    document.location.reload(true);
                }
            }) 
        }
    })

    $("#datasssnovo").click(function(){
        if($("#sadasd").css("display") == "block"){
            $("#sadasd").css("display","none")
        }
        else{
            $("#sadasd").css("display","block")
        }
    })
    $("#formulario").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '/home/localizacoes',
            type: 'POST',
            data: {
                cidade : $("#cidade").val(),
                estado : $("#estado").val(),
                pais : $("#pais").val(),
                endereco : $("#endereco").val(),
                longitude : $("#longitude").val(),
                latitude : $("#latitude").val(),
                observacao : $("#observacao").val(),
                altura : $("#altura").val()
            },
            success: function(res){ 
                console.log(res)
                document.location.reload(true);
            },
            error:function(e){ 
                console.log('ERROR',e)
            }
        }) 
    })

})