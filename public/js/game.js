const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("choice-text"));
const progressText = document.getElementById("progressText");
const scoreText = document.getElementById("score");
const progressBarFull = document.getElementById("progressBarFull");
const loader = document.getElementById("loader");
const game = document.getElementById("game");
let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuesions = [];
let questions = [];
let answeredQuestion = [];
let selectedChoices = [];
let correctAnswer;


fetch('/get_questions')
  .then(res => {
    return res.json();
  })
  .then(loadedQuestions => {
    questions = loadedQuestions.map(loadedQuestion => {
      // console.log(loadedQuestion)
      const formattedQuestion = {
        question: loadedQuestion.question_text,
        questionID: loadedQuestion.id
      };

      const answerChoices = loadedQuestion.question_options.map((options, index) => {
        if(options.points == 0){
           let incorrrect_choices = options.option_text;
           formattedQuestion["choiceID" + (index + 1)] = options.id;
           return incorrrect_choices;
        }
        else{
          formattedQuestion.answer = index+1;
          formattedQuestion["choiceID" + (index + 1)] = options.id;
          let corrrect_choices = options.option_text;
          return corrrect_choices;
        }
      });

      answerChoices.forEach((choice, index) => {
        formattedQuestion["choice" + (index + 1)] = choice;
      });
      
      return formattedQuestion;
    });

// const MAX_QUESTIONS = questions.length;
    // initialize();
    startGame();
  })
  .catch(err => {
    console.error(err);
  });
//CONSTANTS
const CORRECT_BONUS = 5;
// const MAX_QUESTIONS = 5;

startGame = () => {
  questionCounter = 0;
  score = 0;
  availableQuesions = [...questions];
  // console.log(availableQuesions)
  getNewQuestion();
  game.classList.remove("hidden");
  loader.classList.add("hidden");
};

getNewQuestion = () => {
  if (availableQuesions.length === 0 || questionCounter >= questions.length) {
    localStorage.setItem("mostRecentScore", score);
    localStorage.setItem("answeredQuestion", JSON.stringify(answeredQuestion));
    
    const mostRecentScore = localStorage.getItem("mostRecentScore");
    const questions = JSON.parse(localStorage.getItem("answeredQuestion")) || [];
    
    const selectedChoices = JSON.parse(localStorage.getItem("selectedchoices")) || [];
      // console.log(selectedChoices)
    //go to the end page
    $.ajax({
      url: "/test",
      type: "POST",
      data: {
        score: mostRecentScore,
        answered_question: questions,
        selected_choices: selectedChoices,
      },
      beforeSend: function(request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
    });
    return window.location.assign("/end/"+ category_id);
  }
  questionCounter++;
  progressText.innerText = `Question ${questionCounter}/${questions.length}`;
  //Update the progress bar
  progressBarFull.style.width = `${(questionCounter / questions.length) * 100}%`;

  const questionIndex = Math.floor(Math.random() * availableQuesions.length);
  currentQuestion = availableQuesions[questionIndex];
  // console.log(currentQuestion)
  question.innerHTML = currentQuestion.question;
  answeredQuestion.push(currentQuestion.questionID);
  choices.forEach(choice => {
    const number = choice.dataset["number"];
    if(currentQuestion["choice" + number]){
        if(choice.parentElement.style.display=='none'){
            choice.parentElement.style.display='inherit';
        }
      choice.innerHTML = currentQuestion["choice" + number];
      choice.id = currentQuestion["choiceID" + number];
      // console.log(choice.id)
    } else if(!currentQuestion["choice" + number]){
      choice.parentElement.style.display='none';
    }
     });

  availableQuesions.splice(questionIndex, 1);
  acceptingAnswers = true;
  correctAnswer = currentQuestion.answer;
};

correct = () => {
    choices.forEach(choice => {
    if(choice.dataset["number"] == correctAnswer){
      choice.parentElement.classList.add("correct")
    }
    setTimeout(() => {
      choice.parentElement.classList.remove("correct")
      // getNewQuestion();
    }, 2700);
    
  });
};

choices.forEach(choice => {

    choice.addEventListener("click", e => {
    if (!acceptingAnswers) return;
    
    acceptingAnswers = false;
    const selectedChoice = e.target;
    const selectedAnswer = selectedChoice.dataset["number"];
    const classToApply =
      selectedAnswer == currentQuestion.answer ? "correct" : "incorrect";

  // to collect user selected choices
      selectedChoices.push(selectedChoice.id);
      localStorage.setItem('selectedchoices',JSON.stringify(selectedChoices));
      
      if (classToApply === "correct") {
      incrementScore(CORRECT_BONUS);
    }
    selectedChoice.parentElement.classList.add(classToApply);
    setTimeout(() => {
      correct();
    }, 300);

    setTimeout(() => {
      selectedChoice.parentElement.classList.remove(classToApply);
      getNewQuestion();
    }, 3000);
  });
});

incrementScore = num => {
  score += num;
  scoreText.innerText = score;
};
