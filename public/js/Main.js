const shoesSizes = ['38','39','40','41','42','43','44','45','46']; //Taille pour la categorie chaussure 'Shoes'
const tshirtSizes = ['XS','S','M','M-T','L','XL','XXL']; //taille pour la categorie T-shirt

//Recuperation de l'input pour les tailles
let sizeInput = document.getElementById('size-input');
const sizeFilter = [];

//Recuperation des differents category
const categOptions = document.querySelectorAll('.categ-filter-opt');
categOptions.forEach(elt =>{
   if(elt.getAttribute('selected')!=null){
       displaySize(elt.getAttribute('data-name'))
   }
})

//On affiche les différents tailles selon la categorie choisie
function displaySize(categ){
    let sectionSize = document.getElementById('size-section');
    sectionSize.hidden = false;
    let divSize = document.getElementById('filter-size-content');
    divSize.innerHTML = "";

    if(categ == 'Shoes'){
        loadData(sizeInput); 
        shoesSizes.forEach((elt,key) =>{
           divSize.appendChild(createSizeElt(key,elt));
        });
    }else if(categ == 'T-shirt'){
        loadData(sizeInput); 
        tshirtSizes.forEach((elt,key)=>{
            divSize.appendChild(createSizeElt(key,elt));
        });
    }else{
        sectionSize.hidden = true;
    }
    
}

//Creation des elements des tailles
function createSizeElt(key,value){
    
    let btnGroup = document.createElement('div');
    btnGroup.setAttribute('class','btn-group size-btn');
    btnGroup.setAttribute('role','group');
    btnGroup.setAttribute('aria-label','btn Size');
    
    let input = document.createElement('input');
    input.setAttribute('type','checkbox');
    input.setAttribute('class','btn-check');
    input.setAttribute('id','btncheck'+key);
    input.setAttribute('autocomplete','off');
    input.addEventListener('change', () =>{
        if(sizeInput != null){
            if(input.checked){
                sizeFilter.push(value);
            }else{
                sizeFilter.splice(sizeFilter.findIndex(el => el == value),1);
            }
            sizeInput.value = JSON.parse(JSON.stringify(sizeFilter));
        }
    })

    let label = document.createElement('label');
    label.setAttribute('class','btn btn-outline-primary');
    label.setAttribute('for','btncheck'+key);
    label.innerText = value; 

    sizeFilter.forEach(s=>{
        if(s==value){
            input.checked = true;
        }
    })

    btnGroup.appendChild(input);
    btnGroup.appendChild(label);

    return btnGroup;
}

//Chargement des tailles, si il y à déjà une recherche
function loadData(input){
    if(input!=null){
        input.value.split(',').forEach(elt=>{
            sizeFilter.push(elt);
        })
    }
}