let size = this.document.getElementById('sizes');
let categChoice = "none";

const category = document.getElementById('product_category');
categChoice = category.options[category.selectedIndex].text
checkCategChoice(categChoice);

category.addEventListener('change', (e) =>{
    categChoice = category.options[category.selectedIndex].text;
    checkCategChoice(categChoice);
})


function checkCategChoice(categChoice){

    const shoesSizes = ['38','39','40','41','42','43','44','45','46'];
    const tshirtSizes = ['XS','S','M','M-T','L','XL','XXL'];

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

function displaySizesInput(sizesArray){

    let hideSize = this.document.createElement('input');
    hideSize.setAttribute('name',categChoice+'Size');
    hideSize.setAttribute('hidden',true);

    arrayChoice = [];

    size.innerHTML = "";
    size.appendChild(hideSize);
    sizesArray.forEach(elt => {
        let div = document.createElement('div');
        let ckb = document.createElement('input');
        let lbl = document.createElement('label');
        ckb.setAttribute('id',elt);
        ckb.setAttribute('type','checkbox');
        ckb.setAttribute('value',elt);
        ckb.addEventListener('change', ()=>{
            if(ckb.checked){
                arrayChoice.push(elt);
            }else{
                arrayChoice.splice(arrayChoice.findIndex(el => el == elt),1);
            }
            hideSize.value = JSON.stringify(arrayChoice);
        })
        lbl.innerHTML = elt;
        lbl.setAttribute('for',elt);
        div.appendChild(ckb);
        div.appendChild(lbl);
        size.appendChild(div);
    })
}
