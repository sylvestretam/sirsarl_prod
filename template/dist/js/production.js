function showPRODUCTION(PRODUCTION_id)
{
    const PRODUCTION = getPRODUCTION(PRODUCTION_id);
    $('.prod_id').val(PRODUCTION_id);
    $('.date_prod').val(PRODUCTION.date_prod);
    $('.quantite').val(PRODUCTION.quantite);

    let text ="";
    (PRODUCTION.lignes).forEach(element => {
        let txt = 
            `<tr>
                <td> ${element.article} </td>
                <td> ${element.quantite} </td>
                <td> ${element.unite} </td>
            </tr>`;
        text = text.concat(txt);
             
    });
    $('.ligneproduction').html(text);
    back('.sect_list_production','.sect_mod_production');
}


let PRODUCTION = {};

function addLignePRODUCTION()
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
        PRODUCTION[article] = {"quantite":quantite,"unite":unite};
        
        $('.production').val( JSON.stringify(PRODUCTION) );
        writeLignePRODUCTION(PRODUCTION,'.ligneproduction');
    }
}

function removeLignePRODUCTION(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete PRODUCTION[idligne];
    
    if( Object.keys(PRODUCTION).length > 0)
        $('.production').val( JSON.stringify(PRODUCTION) );
    else
        $('.production').val( "" );
    
}

function writeLignePRODUCTION(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        
        let txt = 
            `<tr id="${element}">
                <td> ${element} </td>
                <td> ${lignes[element].quantite} </td>
                <td> ${lignes[element].unite} </td>
                <td> 
                    <button type="button" onclick="removeLignePRODUCTION('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}