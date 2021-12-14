const togglemeny = ()=>{
  
  document.querySelector('.menu').classList.toggle('active')
}
const sliderNext = (id)=>{
  let slider =  document.querySelector('.slider')
  let sliderbuttons = document.querySelectorAll('.slider-button')
  if(id != 'left' || id != 'right'){
    slider.style.transform = `translateX(-${100*id}%)`
    for (let i = 0; i < sliderbuttons.length; i++) {
      sliderbuttons[i].classList.remove('active')
      if(i == id){
        sliderbuttons[i].classList.add('active')
      }
    }
  }else{
    alert(1)
    if(id == 'left'){
      for (let i = 0; i < sliderbuttons.length; i++) {
        if(sliderbuttons[i].classList.contains('active')){
          if(i+1 < sliderbuttons.length){
            slider.style.transform = `translateX(-${100*i+1}%)`
            for (let j = 0; j < sliderbuttons.length; j++) {
              sliderbuttons[j].classList.remove('active')
              if(j == i+1){
                sliderbuttons[j].classList.add('active')
              }
            }
          }else{
            slider.style.transform = `translateX(-${100*0}%)`
            for (let j = 0; j < sliderbuttons.length; j++) {
              sliderbuttons[j].classList.remove('active')
              if(j == 0){
                sliderbuttons[j].classList.add('active')
              }
            }
          }
        }
      }
    }else{

    }
  }
}
setInterval(() => {
  let sliderbuttons = document.querySelectorAll('.slider-button')
  for (let i = 0; i < sliderbuttons.length; i++) {
    if(sliderbuttons[i].classList.contains('active')){
      if(i == sliderbuttons.length-1){
        sliderNext(0)
      }else{
        sliderNext(i+1)
      }
      break
    }
  }
}, 5000);



let photo = document.querySelector('.photo');
let photoHeight = photo.offsetHeight;

document.addEventListener('scroll', function(){
	console.log(1+window.scrollY/-photoHeight);
	photo.style.opacity = 1 + window.scrollY/-photoHeight;
})
function OpenCateg(){
  document.getElementById("categ__menu").classList.toggle("active");
}