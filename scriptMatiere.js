$(document).ready(function(){
    
    for (let i = 1; i <= 100; i++) {
        $('#boutton' + i).click(function() {
            $('#mat' + i).toggle();
        });
        $('#bouttonModif'+ i).click(function(){
            $('#Modif' + i).toggle()
        });
        $('#bouttonEleveT'+i).click(function(){
            $('#eleveT'+i).toggle()
        })
        $('#bouttonE'+i).click(function(){
            $('#eleveG'+i).toggle()
        })

    }
    
    $('#bouttonT').click(function(){
        $('.compTransverse').toggle()
    })

    

    $('.AjouterB').click(function(){
        $('.ajouter').toggle()
    })

    function submitForm() {
        var form = document.getElementById("form");
        form.submit();
    }
    
     
});


