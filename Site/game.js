//localStorage.removeItem(key);

//Get elements by className
const letUsGame = document.querySelector(".btn");
const nameInput = document.querySelector(".user-name");
const gameSection = document.getElementById("gm-sc");
const letterContainer = document.getElementById("letter-container");
const userInputSection = document.getElementById("user-input-section");
const resultText = document.getElementById("result-text");
const newGameContainer = document.getElementById("new-game-container");
const newGameButton = document.getElementById("new-game-button");
const logOutButton = document.getElementById("logout");
const categoryDiv = document.createElement("div");
const balloonContainer = document.getElementById("balloon-container");
const canvasContainer = document.getElementById("canvas");

const categories = {
  animals: [
    {
      name: "Cat",
      hint: "Mewo Mewo",
    },
    {
      name: "Dog",
      hint: "Hawo Hawoo",
    },
    {
      name: "Kangaroo",
      hint: "Has A Pocket",
    },
    {
      name: "Rabbit",
      hint: "Jumping Jumping",
    },
  ],
  movies: [
    {
      name: "Spiderman",
      hine: "Spider Saves World",
    },
    {
      name: "Batman",
      hint: "Bat Saves World",
    },
    {
      name: "Superman",
      hint: "Super power Saves World",
    },
    {
      name: "Transformers",
      hint: "Robots Saves World",
    },
  ],
  books: [
    {
      name: "Math",
      hint: "Calculations",
    },
    {
      name: "Physics",
      hint: "Newten",
    },
    {
      name: "Chemestry",
      hint: "H2o and others",
    },
    {
      name: "Art",
      hint: "Drawning and creative ideas",
    },
  ],
};

let chosenWord = "";
let loosCount = 0;
let winCount = 0;
let counter = 0;

let categoryBtn;

//Hide the Home Page

document.querySelector(".home-page").style.display = "none";

//Function to go to Home Page
const homePage = () => {
  if (nameInput.value) {
    counter = 0;
    resultText.innerHTML = "";

    if (!categoryDiv.hasChildNodes()) {
      //Hide the welcome section dev
      document.querySelector(".welcome-section").style.display = "none";

      //Save the username
      localStorage.setItem("username", nameInput.value);

      //Show the Home Page
      document.querySelector(".home-page").style.display = "flex";

      //Create h3 element
      const welcomeUser = document.createElement("h3");
      welcomeUser.classList.add("user");
      welcomeUser.innerHTML = `Welcome ${localStorage.getItem("username")}`;

      const hintWord = document.createElement("p");
      hintWord.classList.add("user");
      hintWord.id = "hindID";
      hintWord.style.display = "none";
      hintWord.innerHTML = `Hint : `;

      //Create Div for categories
      categoryDiv.classList.add("categories");
      categoryDiv.id = "categoriesId";

      //Append the h3 & div to home-page section
      document.querySelector(".home-page").append(welcomeUser);
      document.querySelector(".home-page").append(hintWord);
      document.querySelector(".home-page").append(categoryDiv);

      //Adding Categories to it's div
      const myNode = document.getElementById("categoriesId");
      while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
      }
      generateCategories();
    } else {
      userInputSection.innerHTML = "";
      gameSection.classList.add("hide");
      letterContainer.classList.add("hide");
      letterContainer.innerHTML = "";

      const myNode = document.getElementById("categoriesId");
      while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
      }
      generateCategories();
    }
  } else {
    counter = 0;
    resultText.innerHTML = "";
    alert("Please Add Your Name");
  }
};

//Function to Create buttons holding Category Names with ids
const generateCategories = () => {
  for (const key in categories) {
    categoryBtn = document.createElement("button");
    categoryBtn.id = key;
    categoryBtn.classList.add("category");
    categoryBtn.innerHTML = `${key}`;
    document.querySelector(".categories").append(categoryBtn);
    categoryBtn.addEventListener("click", generateWords);
  }
};

//Function to hide all elements and show the win or lose div
const blocker = () => {
  //Get the categories buttons
  let categoriesBtn = document.querySelectorAll(".category");
  //Get the letters buttons
  let letterBtn = document.querySelectorAll(".letter");
  //Iterate over categories buttons and disable them
  categoriesBtn.forEach((button) => {
    button.disabled = true;
  });

  //Iterate over letters buttons and disable them
  letterBtn.forEach((button) => {
    button.disabled = true;
  });

  //Show the Game Container(div) and let the display to be flex
  newGameContainer.style.display = "flex";
  //Hide the New game button
  newGameButton.classList.remove("hide");
  canvasContainer.classList.add("hide");
};

//Function to generate words after generating the categories
const generateWords = (event) => {
  //Get the categories buttons
  let categoryBtn = document.querySelectorAll(".category");
  //Iterate over categories buttons check if the text of the button matches the text of the event button
  categoryBtn.forEach((button) => {
    if (button.innerText.toLowerCase() == event.target.innerHTML) {
      //If matches then add active css style to the button
      button.classList.add("active");
      //Call start game function
      startGame();
    }
    //Disable all the non matched buttons
    button.disabled = true;
  });

  //Show the game section
  gameSection.classList.remove("hide");
  //Show the letter container
  letterContainer.classList.remove("hide");
  //user input when clicking on letters make it empty string
  userInputSection.innerText = "";

  //Take the value(Array) of the key which equals to innerhtml
  let words = categories[event.target.innerHTML];
  let wordIndex = Math.floor(Math.random() * words.length);
  //Choose the random word of the array
  chosenWord = words[wordIndex].name.toUpperCase();
  let hint = words[wordIndex].hint;
  const hintDiv = document.getElementById('hindID')
  hintDiv.style.display = 'block'
  hintDiv.innerText = `Hint : ${hint}`
  //Replace every letter from the choosen word with _ (underscore)
  let wordDashed = chosenWord.replace(
    /./g,
    `<span class="dashes" style="background-color: #DAC1B1;">_</span>`
  );
  //let the user input equals to the worddhased : ex "CAT" --> "_ _ _"
  userInputSection.innerHTML = wordDashed;
};

//Function to start the game
const startGame = () => {
  //let the Wincount and loostcount equal to zero
  winCount = 0;
  loosCount = 0;

  //get the audio element by the id
  const mp3 = document.getElementById("myAudio");
  //let the autoplay equals to true
  mp3.autoplay = true;
  //let the loop (repeating the audio) to true
  mp3.loop = true;
  //play the audio
  mp3.load();

  newGameContainer.style.display = "none";
  userInputSection.innerHTML = "";
  gameSection.classList.add("hide");
  letterContainer.classList.add("hide");
  letterContainer.innerHTML = "";
  newGameButton.classList.add("hide");
  canvasContainer.classList.remove("hide");

  // document.getElementById("demo").innerHTML = mp3;

  /*
    Called the inter val function to create an count down timer, the the time exceeds then will pause the mp3 and add loose message then call the blocker function
    to show the message 
    
    */

  const x = setInterval(() => {
    console.log(resultText.innerHTML);
    document.getElementById("demo").innerHTML = `${counter}`;
    counter++;

    if (counter > 59) {
      clearInterval(x);
      mp3.pause();
      balloonContainer.remove();
      resultText.innerHTML = `<h2 class='lose-msg'>You Lose!!</h2><p>The word was <span>${chosenWord}</span></p><p style="color: #DAC1B1">Your Score Is <span>${winCount}</span></p>`;
      blocker();
      // resultText.innerHTML = ""
      counter = 0;

      //quick note about this condition, if the resulttext has value from the above for loop either win or lose, then terminate the interval
    } else if (resultText.innerHTML) {
      clearInterval(x);
      resultText.innerHTML = "";
      counter = 0;
    }
  }, 1000);

  //Start the for loop from 65 and end it on 91, because the letters from "String.fromCharCode()" start from 65 and end on 90
  for (let i = 65; i < 91; i++) {
    //creating character button
    let charButton = document.createElement("button");
    //adding class the char buttons
    charButton.classList.add("letters");
    //adding innertext (letter) to character button from the "String.fromCharCode()"
    charButton.innerText = String.fromCharCode(i);
    //When clicking on one of the character code call the anonymous function
    charButton.addEventListener("click", () => {
      //creating array but splitting the chosen word
      let charArray = chosenWord.split("");
      //get the dashes by class name element
      let dashes = document.getElementsByClassName("dashes");
      /*
            if the character button in the character array then iterate on the array, if the char from the array equals to the character button text then
            replace the dashed button by it's index with the character then increment the wincount by 1,then check if the wincout equals to length of the 
            character array if yes then pause the mp3 and give message you win with the score then call the blocker function to show the message


            if the character button not in the character array, increment the looscount by 1, then if the looscount equals 6 (the max score of loosing) then 
            pause the mp3, and a loose message and wincount if he got some character correct then call the block function

            on each click on character button it will disable the button, then take the button and add it the lette container
            
            */
      if (charArray.includes(charButton.innerText)) {
        charArray.forEach((char, index) => {
          if (char === charButton.innerText) {
            dashes[index].innerText = char;
            winCount += 1;
            if (winCount === charArray.length) {
              let offersList = [];

              fetch(`./Get_Offers.php?place_id=${venueId}`)
                .then((response) => response.json())
                .then((offers) => {
                  offersList = offers;
                  console.log(offersList);

                  const randomElement = getRandomElement(offersList);

                  mp3.pause();
                  resultText.innerHTML = `<h2 class='win-msg'>You Win!!</h2><p>The word was <span>${chosenWord}</span></p><p>Your Score Is <span>${winCount}</span></p>`;
                  // window.addEventListener("load", () => {
                  createBalloons(30);
                  // });
                  blocker();
                  // resultText.innerHTML = ""
                  clearInterval(x);
                  counter = 0;

                  fetch(
                    `./AddWinner.php?offer_id=${randomElement.id}&customer_id=${CID}`
                  )
                    .then((response) => response.json())
                    .then((data) => {
                      if (!data["error"]) {
                        let name;

                        if (
                          randomElement.discount >= 10 &&
                          randomElement.discount < 30
                        ) {
                          name = `Bronze ${randomElement.discount}`;
                        } else if (
                          randomElement.discount >= 30 &&
                          randomElement.discount < 60
                        ) {
                          name = `Silver ${randomElement.discount}`;
                        } else if (
                          randomElement.discount >= 60 &&
                          randomElement.discount <= 100
                        ) {
                          name = `Gold ${randomElement.discount}`;
                        }

                        setTimeout(() => {
                          alert(`You Won ${name}`);
                          document.location = `./Venue.php?venue_id=${venueId}`;
                        }, 5000);
                      }
                    });
                });
            }
          }
        });
      } else {
        loosCount += 1;
        drawMan(loosCount);
        if (loosCount === 6) {
          mp3.pause();
          balloonContainer.remove();
          resultText.innerHTML = `<h2 class='lose-msg'>You Lose!!</h2><p>The word was <span>${chosenWord}</span></p><p>Your Score Is <span>${winCount}</span></p>`;
          blocker();
          clearInterval(x);
          // resultText.innerHTML = ""
          counter = 0;
        }
      }
      charButton.disabled = true;
    });
    letterContainer.append(charButton);
  }

  let { initialDrawing } = canvasCreator();
  //initialDrawing would draw the frame
  initialDrawing();
};

function getRandomElement(arr) {
  const randomIndex = Math.floor(Math.random() * arr.length); // Generate a random index
  return arr[randomIndex]; // Return the element at that index
}

function random(num) {
  return Math.floor(Math.random() * num);
}

function getRandomStyles() {
  var r = random(255);
  var g = random(255);
  var b = random(255);
  var mt = random(200);
  var ml = random(50);
  var dur = random(5) + 5;
  return `
    background-color: rgba(${r},${g},${b},0.7);
    color: rgba(${r},${g},${b},0.7); 
    box-shadow: inset -7px -3px 10px rgba(${r - 10},${g - 10},${b - 10},0.7);
    margin: ${mt}px 0 0 ${ml}px;
    animation: float ${dur}s ease-in infinite
    `;
}

function createBalloons(num) {
  for (var i = num; i > 0; i--) {
    var balloon = document.createElement("div");
    balloon.className = "balloon";
    balloon.style.cssText = getRandomStyles();
    balloonContainer.append(balloon);
  }
}

function removeBalloons() {
  balloonContainer.style.opacity = 0;
  setTimeout(() => {
    balloonContainer.remove();
  }, 500);
}

//CancaCreator function to start drawing the body of the man
const canvasCreator = () => {
  let context = canvas.getContext("2d");
  context.beginPath();
  context.strokeStyle = "#000";
  context.lineWidth = 2;

  //For drawing lines
  const drawLine = (fromX, fromY, toX, toY) => {
    context.moveTo(fromX, fromY);
    context.lineTo(toX, toY);
    context.stroke();
  };

  const head = () => {
    context.beginPath();
    context.arc(70, 30, 10, 0, Math.PI * 2, true);
    context.stroke();
  };

  const body = () => {
    drawLine(70, 40, 70, 80);
  };

  const leftArm = () => {
    drawLine(70, 50, 50, 70);
  };

  const rightArm = () => {
    drawLine(70, 50, 90, 70);
  };

  const leftLeg = () => {
    drawLine(70, 80, 50, 110);
  };

  const rightLeg = () => {
    drawLine(70, 80, 90, 110);
  };

  //initial frame
  const initialDrawing = () => {
    //clear canvas
    context.clearRect(0, 0, context.canvas.width, context.canvas.height);
    //bottom line
    drawLine(10, 130, 130, 130);
    //left line
    drawLine(10, 10, 10, 131);
    //top line
    drawLine(10, 10, 70, 10);
    //small top line
    drawLine(70, 10, 70, 20);
  };

  return { initialDrawing, head, body, leftArm, rightArm, leftLeg, rightLeg };
};

//draw the man
const drawMan = (loosCount) => {
  let { head, body, leftArm, rightArm, leftLeg, rightLeg } = canvasCreator();
  switch (loosCount) {
    case 1:
      head();
      break;
    case 2:
      body();
      break;
    case 3:
      leftArm();
      break;
    case 4:
      rightArm();
      break;
    case 5:
      leftLeg();
      break;
    case 6:
      rightLeg();
      break;
    default:
      break;
  }
};

// After user add his/her name, click on the let Us game to open the home page
letUsGame.addEventListener("click", homePage);
//After losing or winning the new game button to get back to the home page
newGameButton.addEventListener("click", homePage);

// window.addEventListener("click", () => {
//     removeBalloons();
// });

//Logout button to clear the local storage and get back the welcome home page
logOutButton.addEventListener("click", () => {
  localStorage.removeItem("username");
  location.reload();
});
