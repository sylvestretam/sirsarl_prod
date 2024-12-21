function showConsommation(conso_id)
{
    const consommation = getconsommation(conso_id);

    $('.conso_id').val(conso_id);
    $('.date_conso').val(consommation.date_conso);
    $('.valeur_total').val(consommation.valeur);

    let text ="";
    (consommation.lignes).forEach(element => {
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
    $('.ligne_consommation').html(text);
    back('.sect_list_consommation','.sect_mod_consommation');
}

// function setUniteMP(e)
// {
//     let code_mp = $(e).val();
//     let mp = getMP(code_mp);
//     $('#unitemp').val(mp.unite);
// }

let LIGNES_CONSOMMATIONS;
let consommation = {};

function addLigneconsommation()
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
        consommation[mp] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        
        $('.consommation').val( JSON.stringify(consommation) );
        writeLigneconsommation(consommation,'.ligneconsommation');
    }
}

function removeLigneconsommation(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete consommation[idligne];
    
    if( Object.keys(consommation).length > 0)
        $('.consommation').val( JSON.stringify(consommation) );
    else
        $('.consommation').val( "" );
    
}

function writeLigneconsommation(lignes,tbody)
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
                    <button type="button" onclick="removeLigneconsommation('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}