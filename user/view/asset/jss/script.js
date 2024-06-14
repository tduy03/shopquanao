
const sliderItem= document.querySelectorAll('.slider-item')
for (let index = 0; index < sliderItem.length; index++) {
    sliderItem[index].style.left= index*100 + "%";

}
const sliderItems= document.querySelector('.slider-items')
const arrowright= document.querySelector('.ri-arrow-right-fill')
const arrowleft= document.querySelector('.ri-arrow-left-fill')

let i= 0;
if(arrowright!=null && !arrowleft!=null){
    //Nút bấm slide
arrowright.addEventListener('click',()=>{
    
    if(i<sliderItem.length-1){
        i++
        sliderMove(i)
    }else{
        return false;
    }
})

arrowleft.addEventListener('click',()=>{
    
    if(i<=0){
        return false;
    }else{
        i--
        sliderMove(i)
       
    }
})
}

//Di chuyển slide
function autoSlider(){
    
    if(i<sliderItem.length-1){
    i++
    sliderMove(i)
    }else{
        i=0
        sliderMove(i)
    }
}
function sliderMove(i){
    sliderItems.style.left= -i*100+ "%"
}
setInterval(autoSlider,5000)

//menuBar responsive
const menuBar= document.querySelector('.header-bar-icon')
const headerNav= document.querySelector('.header-nav')
menuBar.addEventListener('click',()=>{
    headerNav.classList.toggle('active');
})

//Sticky header
window.addEventListener('scroll',()=>{
    if(scrollY>50){
        document.querySelector('#header').classList.add('active')
    }else{
        document.querySelector('#header').classList.remove('active')
    }
})

//click product detail
const imageSmall= document.querySelectorAll('.product-images-items img')
const imageMain= document.querySelector('.main-image')
for (let index = 0; index < imageSmall.length; index++) {
    imageSmall[index].addEventListener('click',()=>{
        imageMain.src= imageSmall[index].src
        //Loại bỏ hết active
        for (let index1 = 0; index1 < imageSmall.length; index1++) {
            imageSmall[index1].classList.remove('active')
        }
        //Add active khi được click
        imageSmall[index].classList.add('active')
    })
    
}

// Số lượng sản phẩm
const quanPlus = document.querySelector('.ri-add-line');
const quanMinus = document.querySelector('.ri-subtract-line');
const quanInput = document.querySelector('.quantity-input');
let quan = 1;

if (quanPlus !== null && quanMinus !== null) {
    quanPlus.addEventListener('click', () => {
        quan++;
        quanInput.value = quan;
    });
    quanMinus.addEventListener('click', () => {
        if (quan <= 1) {
            return false;
        } else {
            quan--;
            quanInput.value = quan;
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const sizes = document.querySelectorAll('.product-detail-right-size-c span');

    sizes.forEach(function(size) {
        size.addEventListener('click', function() {
            // Loại bỏ lớp active của tất cả các size khác
            sizes.forEach(function(s) {
                s.classList.remove('active');
            });
            // Thêm lớp active cho size được click
            size.classList.add('active');
        });
    });
});
// Loại bỏ lựa chọn khi người dùng chọn một size mới
document.querySelectorAll('.size-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            document.querySelectorAll('.size-checkbox').forEach(function(otherCheckbox) {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        }
    });
});
