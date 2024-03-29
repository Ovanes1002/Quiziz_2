// const 
// nextButton = document.querySelector(".nextButton"),
// endButton           = document.querySelector(".endButton"),
// buttons             = document.querySelectorAll(".button"),
// points              = document.querySelector(".points"),
// firstWriteAnswer    = document.querySelector(".firstWriteAnswer"),
// secondWriteAnswer   = document.querySelector(".secondWriteAnswer"),
// thirdWriteAnswer    = document.querySelector(".thirdWriteAnswer");

nextButton.addEventListener("click", (evt) => {
  // удаляем тень у каждой кнопки с классом "buttons"
  buttons.forEach((button) => {
    button.style.boxShadow = "none";
  });
  console.log(points.innerText);
  console.log(result);
  console.log(lastClickedButton);
  console.log(lastClickedButton.element.textContent);
  // проверяем, содержит ли последняя кликнутая кнопка класс "true"
  if (
    lastClickedButton !== null &&
    lastClickedButton.class &&
    points.innerText == "1 балл"
    
  ) {
    result++; // увеличиваем счетчик на 1
  } else if (
    lastClickedButton !== null &&
    lastClickedButton.class &&
    points.innerText == "2 балла"
  ) {
    result += 2; // увеличиваем счетчик на 2

  } else {
    console.log('ОШИБКА');
  }
  console.log(result);
  if (firstWriteAnswer.value == "5" && lastClickedTopic == 'спорт') result += 3;
  else if (firstWriteAnswer.value == "18" && lastClickedTopic == 'музыка') result += 3;
  else if (firstWriteAnswer.value == "284" && lastClickedTopic == 'искусство') result += 3; //
  else if (firstWriteAnswer.value == "1961" && lastClickedTopic == 'история') result += 3; // изменить

  if (secondWriteAnswer.value == "245" && lastClickedTopic == 'спорт') result += 3;
  else if (
    secondWriteAnswer.value.toUpperCase() === "СКРИПКА" &&
    lastClickedTopic == 'музыка'
  )
    result += 3;
  else if (secondWriteAnswer.value.toUpperCase() === "ДАЛИ" && lastClickedTopic == 'искусство')
    result += 3; // изменить
  else if (
    secondWriteAnswer.value.toUpperCase() === "ЯПОНИЯ" &&
    lastClickedTopic == 'история'
  )
    result += 3; // изменить

  firstWriteAnswer.value = "";
  secondWriteAnswer.value = "";
  thirdWriteAnswer.value = "";


  if (quizList.length > +currentQuestionIndex + 1) {
    currentQuestionIndex++;
    setQuestion();

  }
  updateProgress(10); // увеличение прогресса на 10%
  nextButton.classList.add("hide");
});
