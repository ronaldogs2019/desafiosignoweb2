	$(document).ready(function(){
		jQuery("#Telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });

        $("#Data_de_Nascimento").mask("99/99/9999", {
    	completed: function () {
        var value = $(this).val().split('/');
        var maximos = [31, 12, 2100];
        var novoValor = value.map(function (parcela, i) {
            if (parseInt(parcela, 10) > maximos[i]) return maximos[i];
            return parcela;
        });
        if (novoValor.toString() != value.toString()) $(this).val(novoValor.join('/')).focus();
	    }    
	});
      
});