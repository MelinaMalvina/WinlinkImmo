

function envoyer() {

   myObj = {
       type: getTypeBien(),
       statut: getStatutBien(), 
       lieu: getLieuBien(),
       piece: getPieceBien(),
       mettreCarre: getMettreCaree(),
       maRange: {
           min: maRange[0],
           max: maRange[1]
       }
   }                                                
 
    console.log(myObj);

  }

// recuperation du type de bien 
  function getTypeBien() {
     type = document.getElementById("property-type");
     return type.options[type.selectedIndex].text; 

  }

// recuperation du statut
function getStatutBien() {
    statut = document.getElementById("property-status");
    return statut.options[statut.selectedIndex].text;
}

// recuperation du lieu 
function getLieuBien() {
    lieu = document.getElementById("property-localisation");
    return lieu.options[lieu.selectedIndex].text;
}

//recuperation nombre de piece 
function getPieceBien() {
    piece = document.getElementById("property-rooms"); 
    return piece.options[piece.selectedIndex].text;
}


//recuperation metre carré
function getMettreCaree() {

var metreCarreMin = document.getElementById("areaMin").value;
var metreCarreMax = document.getElementById("areaMax").value; 

return {
    min: metreCarreMin,
    max: metreCarreMax
}
}

/*

// recuperation du prix  1er essaie peu concluant. 
    var prix = document.getElementsByClassId("prix"); 
    console.log(prix);
  

*/