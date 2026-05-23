let aperto = false; 

function soptis_toggleMenu() { 
    if (!aperto) { 
        apriMenu(); // prima funzione 
        aperto = true; 
    } 
    else { 
        chiudiMenu(); // seconda funzione 
        aperto = false; 
    } 
}

function soptis_apriMenu() {
    const height = document.querySelector("#header").getBoundingClientRect().height;
    const mobileMenu = document.querySelector("#mobile_menu");

    mobileMenu.style.setProperty('--height-mobile-menu', `${height}px`);
    mobileMenu.classList.remove('mobile_menu_close');
    mobileMenu.classList.add('mobile_menu_open');

    
    
    const mobileButton = document.querySelector("#mobile_button");
    mobileButton.innerHTML = "<i class=\"fas fa-times fa-2x\"></i>";
    
}

function soptis_chiudiMenu(){
    const mobileMenu = document.querySelector("#mobile_menu"); 
    mobileMenu.classList.remove('mobile_menu_open');
    mobileMenu.classList.add('mobile_menu_close');


    const mobileButton = document.querySelector("#mobile_button");
    mobileButton.innerHTML = "<i class=\"fas fa-bars fa-2x\"></i>";
}