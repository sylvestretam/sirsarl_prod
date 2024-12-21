function showAchat(achat_id)
{
    const achat = getAchat(achat_id);
    $('.achat_id').val(achat_id);
    $('.date_achat').val(achat.date_achat);
    $('.valeur_total').val(achat.valeur);

    let text ="";
    (achat.lignes).forEach(element => {
        let mp = getMP(element.matiere_premiere);
        let txt = 
            `<tr>
                <td> ${mp.designation} </td>
                <td> ${element.quantite} </td>
                <td> ${mp.unite} </td>
                <td> ${ element.valeur / element.quantite } </td>
                <td> ${element.valeur} </td>
            </tr>`;
        text = text.concat(txt);
             
    });
    $('.ligne_achat').html(text);
    back('.sect_list_achat','.sect_mod_achat');
}

function setUniteMP(e)
{
    let code_mp = $(e).val();
    let mp = getMP(code_mp);
    $('#unitemp').val(mp.unite);
}

let LIGNES_ACHATS;
let ACHAT = {};

function addLigneAchat()
{
    let mp = $('#mp').val();
    let quantite = $('#quantite').val();
    let unite = $('#unitemp').val();
    let valeur = $('#valeur').val();

    if(quantite == "" || valeur == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        ACHAT[mp] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        
        $('.achat').val( JSON.stringify(ACHAT) );
        writeLigneAchat(ACHAT,'.ligneachat');
    }
}

function removeLigneAchat(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete ACHAT[idligne];
    
    if( Object.keys(ACHAT).length > 0)
        $('.achat').val( JSON.stringify(ACHAT) );
    else
        $('.achat').val( "" );
    
}

function writeLigneAchat(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        let mp = getMP(element);
        let txt = 
            `<tr id="${element}">
                <td> ${mp.designation} </td>
                <td> ${lignes[element].quantite} </td>
                <td> ${mp.unite} </td>
                <td> ${lignes[element].valeur} </td>
                <td> ${ lignes[element].valeur / lignes[element].quantite } </td>
                <td> 
                    <button type="button" onclick="removeLigneAchat('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}