//On récupère l'élement sizes de la page
let size = this.document.getElementById('sizes');
let categChoice = "none";

const shoesSizes = ['38','39','40','41','42','43','44','45','46']; //Taille pour la categorie chaussure 'Shoes'
const tshirtSizes = ['XS','S','M','M-T','L','XL','XXL']; //taille pour la categorie T-shirt

//On récupère l'element product_category, c'est la balise select
const category = document.getElementById('product_category');
categChoice = category.options[category.selectedIndex].text //On recupère la catégorie choisie au chargement, ou reload de la page après envoie du formulaire
checkCategChoice(categChoice); //On verifie la categorie

/**
 * On check si la category à été modifer,
 * Si oui, on récupère la catégory selectionner,
 * On verifie la categorie pour afficher ses propriétés
*/
category.addEventListener('change', (e) =>{
    categChoice = category.options[category.selectedIndex].text;
    checkCategChoice(categChoice);
})

/**
 * On verifie si la categorie choisie correspond à 'Shoes' ou 'T-shirt'
 * Si c'est le cas, on affiche les différents tailles de la categorie
 * @param categChoice 
 */
function checkCategChoice(categChoice){

    console.log(categChoice);
    switch(categChoice){
        case 'Shoes':
            displaySizesInput(shoesSizes);
            break;
        case 'T-shirt':
            displaySizesInput(tshirtSizes);
            break;
        case 'None':
            size.innerHTML = "";
    }

}

/**
 * Permet d'afficher les différents tailles selon la categorie choisie
 * On creer une div pour chaque element de la liste des tailles
 * @param sizesArray 
 */
function displaySizesInput(sizesArray){

    let hideSize = this.document.getElementById('sizeInput');

    arrayChoice = [];

    size.innerHTML = "";
    size.appendChild(hideSize);
    sizesArray.forEach(elt => {
        let div = document.createElement('div');
        div.setAttribute('class','size-cb');
        div.setAttribute('id',elt)
        let ckb = document.createElement('input');
        let lbl = document.createElement('label');
        ckb.setAttribute('id',elt);
        ckb.setAttribute('type','checkbox');
        ckb.setAttribute('value',elt);
        ckb.setAttribute('hidden',true);
        lbl.innerHTML = elt;
        lbl.setAttribute('class','size-cb-lbl');
        div.appendChild(ckb);
        div.appendChild(lbl);
        size.appendChild(div);
        div.addEventListener('click', (e)=>{
            if(!ckb.checked){
                arrayChoice.push(elt);
                ckb.checked = true;
                div.setAttribute('class','size-cb size-selected');
            }else{
                arrayChoice.splice(arrayChoice.findIndex(el => el == elt),1);
                ckb.checked = false;
                div.setAttribute('class','size-cb');
            }
            hideSize.value = JSON.parse(JSON.stringify(arrayChoice));
        })
    });

    //Lors d'une erreur sur le formulaire, on retourne sur la page,
    //On verifie si des tailles ont éte sélectionner
    //Si oui, on compare les tailles selectionner, on modifie l'attribut checked à true
    if(hideSize.getAttribute("data-size")){
        let ds = hideSize.getAttribute("data-size");
        JSON.parse(ds).forEach(elt =>{
            sizesArray.forEach(elt1 =>{
                if(elt === elt1){
                    let sizeDiv = document.getElementById(elt);
                    sizeDiv.firstChild.checked = true
                    console.log(sizeDiv.firstChild)
                    sizeDiv.setAttribute('class','size-cb size-selected');
                    arrayChoice.push(elt);
                    hideSize.value = JSON.parse(JSON.stringify(arrayChoice));
                }
            })
        })
    }
    
}
