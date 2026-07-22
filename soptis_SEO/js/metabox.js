jQuery(function($){

    const min = 50;
    const max = 155;

    // Creo un elemento per mostrare il messaggio
    let msg = $('<p id="descrizione_seo_msg" style="margin-top:5px;"></p>');
    $('#descrizione_seo').after(msg);

    $('#descrizione_seo').on('input', function(){

        let length = $(this).val().length;

        if (length < min) {
            msg.css('color', 'red');
            msg.text("La descrizione deve essere almeno di " + min + " caratteri (" + length + " attuali).");
        } 
        else if (length > max) {
            msg.css('color', 'red');
            msg.text("La descrizione non deve superare " + max + " caratteri (" + length + " attuali).");
        } 
        else {
            msg.css('color', 'green');
            msg.text("Lunghezza corretta (" + length + " caratteri).");
        }

    });

});

jQuery(function($){

    const min = 50;
    const max = 65;

    // Creo un elemento per mostrare il messaggio
    let msg = $('<p id="descrizione_seo_msg" style="margin-top:5px;"></p>');
    $('#title_seo').after(msg);

    $('#title_seo').on('input', function(){

        let length = $(this).val().length;

        if (length < min) {
            msg.css('color', 'red');
            msg.text("il titolo deve essere almeno di " + min + " caratteri (" + length + " attuali).");
        } 
        else if (length > max) {
            msg.css('color', 'red');
            msg.text("il titolo non deve superare " + max + " caratteri (" + length + " attuali).");
        } 
        else {
            msg.css('color', 'green');
            msg.text("Lunghezza corretta (" + length + " caratteri).");
        }

    });

});