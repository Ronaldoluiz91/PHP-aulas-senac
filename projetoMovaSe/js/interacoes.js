//Interação do slider (carrocel)
$(document).ready(function(){
    $('#destaque').slick({
        autoplay: true,
        autoplaySpeed:4000,
        dots:true,
        arrows:false
    });
});

//Interção MENU
function clickMenu(){
    if(itens.style.display == 'block'){
        itens.style.display ='none'
    }else{
        itens.style.display = 'block'
    }
}