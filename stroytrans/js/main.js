//Блок с вопросами
const question = document.getElementsByClassName('question__item');
for (i = 0; i < question.length; i++){
  question[i].addEventListener('click', function(){
    this.classList.toggle("question__item_sec");
  })
}

//Проверка формы перед отправкой
//Доработать валидацию формы для проверки на патерн
form.addEventListener('submit', function(evt) {
  var name = document.getElementById("name__form");
  var email = document.getElementById("email_form");
  var phone = document.getElementById("phone__form");
  evt.preventDefault();
  if(!name.value){
    alert("Поле имя не заполненно");
    return;
  }
  if(!email.value){
    alert("Поле почты не заполненно");
    return;
  }
  if(!phone.value){
    alert("Поле телефона не заполненно");
    return;
  }

  this.submit();
  alert("Письмо было успешно отправлено")
});
