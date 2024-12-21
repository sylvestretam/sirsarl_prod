function showExpedition(expedition_id)
{
    const expedition = getExpedition(expedition_id);
    $('.expedition_id').val(expedition_id);
    $('.date_expedition').val(expedition.date_expedition);
    $('.quantite').val(expedition.quantite);

    let text ="";
    (expedition.lignes).forEach(element => {
        let txt = 
            `<tr>
                <td> ${element.article} </td>
                <td> ${element.quantite} </td>
                <td> ${element.unite} </td>
            </tr>`;
        text = text.concat(txt);
             
    });
    $('.ligneexpedition').html(text);
    back('.sect_list_expedition','.sect_mod_expedition');
}

let EXPEDITION = {};

function addLigneExpedition()
{
    let article = $('#article').val();
    let quantite = $('#quantite').val();
    let unite = $('#unite').val();

    if(quantite == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        EXPEDITION[article] = {"quantite":quantite,"unite":unite};
        
        $('.expedition').val( JSON.stringify(EXPEDITION) );
        writeLigneExpedition(EXPEDITION,'.ligne_expedition');
    }
}

function removeLigneExpedition(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete EXPEDITION[idligne];
    
    if( Object.keys(EXPEDITION).length > 0)
        $('.expedition').val( JSON.stringify(EXPEDITION) );
    else
        $('.expedition').val( "" );
    
}

function writeLigneExpedition(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        let txt = 
            `<tr id="${element}">
                <td> ${element} </td>
                <td> ${lignes[element].quantite} </td>
                <td> ${lignes[element].unite} </td>
                <td> 
                    <button type="button" onclick="removeLigneExpedition('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}