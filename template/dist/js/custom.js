function showFTProspects(matricule)
{
    const FT = getFT(food_truckers,matricule);
    // $('.employee').val(matricule);
    // $('.employee_nom').val(dmd.Employee.noms+" "+dmd.Employee.prenoms);

    let text="";
    (FT.prospects).forEach(element=>{
        
        if(element.food_trucker == matricule){
            let txt = 
                `<tr class="">
                    <td> ${element.date_prospection} </td>
                    <td> ${element.noms} </td>
                    <td> ${element.contact} </td>
                    <td> ${element.adresse} </td>
                    <td> ${element.nom_point_de_vente} </td>
                    <td> ${element.type_point_de_pointe} </td>
                    <td>${element.Commande.total}</td>
                    <td>
                        <button type="button" class="btn btn-default pointer btn-sm" onclick="showProspect('${element.prospection_id}')"> 
                            <i class="fas fa-search"></i>
                        </button>
                    </td>
                </tr>`;
            text = text.concat(txt);
            
        }

        });
        
    $('.tablistprospect').html(text);
    back('.sect_list_food_trucker','.sect_list_propect');
}

function showFTRapport(matricule)
{
    const FT = getFT(food_truckers,matricule);

    let text="";
    (FT.rapports).forEach(element=>{
        
        let txt = 
                `<tr class="">
                    <td> ${element.date_jour} </td>
                    <td> ${FT.target_prospection} </td>
                    <td> ${element.prospection} </td>
                    <td> ${element.observation} </td>
                </tr>`;
        text = text.concat(txt);

    });
        
    $('.tablistrapports').html(text);
    back('.sect_list_food_trucker','.sect_list_rapport');
}

function showProspect(prospect_id)
{
    let prospect = getProspect(prospects,prospect_id);

    if(prospect.status == 'ACTIVE')
    {
        $('.txt_message_error').html(`LE PROSPECT <b>${prospect.noms}</b> est déjà activé. Vous ne pouvez plus le modifier !!!`);
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        $('.prospect_id').val(prospect.prospection_id);
        $('.date_prospection').val(prospect.date_prospection);
        $('.noms').val(prospect.noms);
        $('.contact').val(prospect.contact);
        $('.date_prospection').val(prospect.date_prospection);
        $('.adresse').val(prospect.adresse);
        $('.nom_point_de_vente').val(prospect.nom_point_de_vente);
        $('.type_point_de_vente').val(prospect.type_point_de_pointe);

        $('.total_commande').html(prospect.Commande.total);

        let text="";
        (prospect.Commande.lignes_commande).forEach(element=>{
            
            let txt = 
                    `<tr class="">
                        <td> ${element.article} </td>
                        <td> ${element.quantite} </td>
                        <td> ${element.unite} </td>
                        <td> ${element.valeur} </td>
                    </tr>`;
            text = text.concat(txt);

        });
        $('.tablistlignecommande').html(text);

        $(`input[value='${prospect.status}']`).prop('checked',true);

        back('.sect_list_propect','.sect_mod_propect');        
       
    }
}

function showStock(magasin)
{
    
    back('.sect_list_magasin','.sect_list_stock'); 
}

function showPV(code_pv)
{
    const pv = getPV(pvs,code_pv);

    $('.code_pv').val(code_pv);
    $('.prospect').val(pv.prospect);
    $('.nom').val(pv.nom);
    $('.type').val(pv.type);
    $('.proprietaire').val(pv.Prospect.noms);
    $('.adresse').val(pv.Prospect.adresse);
    $('.date_prospection').val(pv.Prospect.date_prospection);
    $('.date_activation').val(pv.Prospect.date_prospection);
    
    let text="";
    (pv.Prospect.Commande.lignes_commande).forEach(element=>{
        
        let txt = 
                `<tr class="">
                    <td> ${element.article} </td>
                    <td> ${element.quantite} </td>
                    <td> ${element.unite} </td>
                    <td> ${element.valeur} </td>
                </tr>`;
        text = text.concat(txt);

    });
    $('.tablistlignecommande').html(text);

    text="";
    (pv.activation.lignes_activations).forEach(element=>{
        
        let txt = 
                `<tr class="">
                    <td> ${element.article} </td>
                    <td> ${element.quantite} </td>
                    <td> ${element.unite} </td>
                    <td> ${element.valeur} </td>
                </tr>`;
        text = text.concat(txt);

    });
    $('.tablistligneactivation').html(text);

    back('.sect_list_pv','.sect_mod_pv'); 
}
