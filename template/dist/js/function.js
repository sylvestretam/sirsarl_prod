function back(active,future)
{
    $(active).addClass('invisible');
    $(future).removeClass('invisible');
}

function format(number)
{
    var options = {maximumFractionDigits:2};
    return number.toFixedDown(2);
}

function getMP(code_mp)
{
    return matieres_premieres.find(element=> element.code_mp == code_mp);
}

function getAchat(achat_id)
{
    return achats.find(element=> element.achat_id == achat_id);
}

function getconsommation(conso_id)
{
    return consommations.find(element=> element.conso_id == conso_id);
}

function getPRODUCTION(prod_id)
{
    return productions.find(element=> element.prod_id == prod_id);
}

function getExpedition(expedition_id)
{
    return expeditions.find(element=> element.expedition_id == expedition_id);
}



function getPV(pvs,code_pv)
{
    return pvs.find(element=> element.code_pv == code_pv);
}


function getReception(receptions,reception_id)
{
    return receptions.find(element=> element.reception_id == reception_id);
}

function getSortieFT(sortiesFT,sortie_id)
{
    return sortiesFT.find(element=> element.sortie_id == sortie_id);
}

function getRetour(retours,retour_id)
{
    return retours.find(element=> element.retour_id == retour_id);
}

function getSortiePV(sortiesPV,sortie_id)
{
    return sortiesPV.find(element=> element.sortie_id == sortie_id);
}


