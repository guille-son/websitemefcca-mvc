function eventListeners() {
    //Cuando arranca la app
    document.addEventListener('DOMContentLoaded', iniciarPagina);
}

function iniciarPagina() {
}

const btnf = document.querySelector('.btn-flotante');

const linklive = document.querySelector('#btn-envivo')['href'];
const fb = 'fb.watch';
const ffb = 'https://www.facebook.com/';

    if(linklive.indexOf(fb) > -1)
    { 
        btnf.style.display = 'flex';
        btnf.style.justifyContent = 'center';
        btnf.style.alignItems = 'center';
    }else if  (linklive.indexOf(ffb) > -1){
        btnf.style.display = 'flex';
        btnf.style.justifyContent = 'center';
        btnf.style.alignItems = 'center';
    }else{
        btnf.style.display = 'none';
    }