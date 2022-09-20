const addres=document.getElementById("addres_info");
const btn=document.getElementById("change_addres");
const btn_save=document.getElementById("save_addres_btn");

btn.onclick=function(){
    addres.removeAttribute("disabled");
    btn_save.style.display="block";
    btn.style.display="none";

}
const kol_item=document.querySelectorAll(".kol_item");
const minus=document.querySelectorAll(".minus");
const plus=document.querySelectorAll(".plus");
const max_kol=document.querySelectorAll(".max_kol");
var index_item;
const span_total=document.querySelector(".span_total");
const prise=document.querySelectorAll(".prise");
minus.forEach((button, index) => {
    button.addEventListener('click', () => {
        index_item=index;
        if( kol_item[index_item].value>1){
            kol_item[index_item].value--;
            var prise_int=parseInt(prise[index_item].innerHTML);
            var total=parseInt(span_total.innerHTML);
            total-=prise_int;
            span_total.innerHTML=total
        }
    })
})
plus.forEach((button, index) => {
    button.addEventListener('click', () => {
        index_item=index;
        if( kol_item[index_item].value<max_kol[index_item].value){
            kol_item[index_item].value++;
            var prise_int=parseInt(prise[index_item].innerHTML);
            var total=parseInt(span_total.innerHTML);
            total+=prise_int;
            span_total.innerHTML=total;
        }
    })
})
const basket=document.querySelector(".basket");
if(basket.innerText===''){
    basket.innerHTML='<p class="null_basket">Корзина пуста</p>';
}
const btn_proverka=document.querySelector(".btn_proverka");
const modal_window=document.querySelector(".modal_window");
const modal_window_info=document.querySelector(".modal_window_info");
const btn_MD=document.querySelector(".btn_MD");
const js_info=document.querySelector(".js_info");
const Name=document.querySelectorAll(".Name");

btn_proverka.onclick=function(){
    if(addres.value==""){
        modal_window.style.display='flex';
    }
    else{
        modal_window_info.style.display='flex';
        for(let i=0; i<kol_item.length;i++){
            if(kol_item[i].value!=0){
                js_info.innerHTML+=Name[i].innerHTML+'   '+kol_item[i].value+' шт.'+' <input type="hidden" class="kol_item" name="kol_item[]" value="'+kol_item[i].value+'"/> <br>';
            }
        }
        js_info.innerHTML+='<p><strong> Итого: <span class="span_total">'+span_total.innerHTML+'</span> Руб.</strong></p>'
    }
}
btn_MD.onclick=function(){
    modal_window.style.display='none';
}
const cancel=document.getElementById("cancel");
cancel.onclick=function(){
    modal_window_info.style.display='none';
    js_info.innerHTML='';
}


