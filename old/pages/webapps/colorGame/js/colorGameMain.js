
// globals
// gameOver flag
var gameOver = false;
// hard flag
var isHard = true;
initHardMode();

// add some events to easy-hard button
var easyBtn = document.querySelector("#easyBtn");
var hardBtn = document.querySelector("#hardBtn");
easyBtn.addEventListener("click", function(){
	this.classList.add("selected");
	hardBtn.classList.remove("selected");
	if(isHard){
		isHard = false;
		initEasyMode();
	}
})
hardBtn.addEventListener("click", function(){
	this.classList.add("selected");
	easyBtn.classList.remove("selected");
	if(!isHard){
		isHard = true;
		initHardMode();
	}
})



// helper functions
function getRandom(min, max){
	return Math.floor(Math.random() * (max+1-min) + min);
}

function getRandRGB(){
	return "RGB(" + getRandom(100,255) + ", " + getRandom(100,255) + ", " + getRandom(100,255) + ")";
}

function initColors(num){
	var initColors = [getRandRGB()];
	for(var i=0;i<num-1;i++){
		initColors.push(getRandRGB());
	}
	return initColors;
}

function pickSquare(){
	return getRandom(0,5);
}

function setSquaresColor(squares, colors){
	for(var i=0; i<squares.length; i++){
		squares[i].style.background = colors[i];
	}
}

function setSquaresEvent(squares){
	for(var i=0; i<squares.length; i++){
		squares[i].addEventListener("click", function squaresEvent(){
			if(!gameOver){
				if(this.classList.contains("picked")){
					// set all other square to this color
					for(var i=0; i<squares.length; i++){
						squares[i].style.background = this.style.background;
					}
					gameOver = true;
					changeStatusDisplay("Good Job!")
					changeHeadColor(this.style.background);
					
				}else{
					this.style.background = "#232323";
					changeStatusDisplay("Try Again!")
				}
			}
		});
	}
}

function changeStatusDisplay(text){
	var statusDisplay = document.querySelector("#statusDisplay");
	statusDisplay.textContent = text;
}

function changeHeadColor(color){
	var h1 = document.querySelector("h1");
	h1.style.background = color;
}

function clearSelect(squares){
	for(var i=0; i<squares.length; i++){
		squares[i].classList.remove("picked");
	}
}

function initHardMode(){
	changeStatusDisplay("");
	gameOver = false;
	changeHeadColor("#232323");
	// init colors and fill the square
	var squares = document.querySelectorAll(".square");
	var colors = initColors(squares.length);
	setSquaresColor(squares, colors);
	setSquaresEvent(squares);
	// pick a color to be the target
	var pickedSquare = pickSquare();
	var pickedColorDisplay = document.querySelector("#pickedColorDisplay");
	pickedColorDisplay.textContent = colors[pickedSquare];
	squares[pickedSquare].classList.add("picked");
	// add some events
	setSquaresEvent(squares);
	// add some events to new color button
	var resetButton = document.querySelector("#newColor");
	resetButton.addEventListener("click", function(){
		colors = initColors(squares.length);
		setSquaresColor(squares, colors);
		clearSelect(squares);
		pickedSquare = pickSquare();
		pickedColorDisplay.textContent = colors[pickedSquare];
		squares[pickedSquare].classList.add("picked");
		gameOver = false;
		changeHeadColor("#232323");
		changeStatusDisplay("");
	})
}

function initEasyMode(){
	changeStatusDisplay("");
	gameOver = false;
	changeHeadColor("#232323");
	// init colors and fill the square
	var squares = document.querySelectorAll(".square");
	var colors = initColors(squares.length);
	setSquaresColor(squares, colors);
	setSquaresEvent(squares);
	// pick a color to be the target number:0~2
	var pickedSquare = getRandom(0,2);
	var pickedColorDisplay = document.querySelector("#pickedColorDisplay");
	pickedColorDisplay.textContent = colors[pickedSquare];
	squares[pickedSquare].classList.add("picked");
	// add some events
	setSquaresEvent(squares);
	// cover last 3 squares
	coverSquare(squares);
	// add some events to new color button
	var resetButton = document.querySelector("#newColor");
	resetButton.addEventListener("click", function(){
		colors = initColors(squares.length);
		setSquaresColor(squares, colors);
		coverSquare(squares);
		clearSelect(squares);
		pickedSquare = getRandom(0,2);
		pickedColorDisplay.textContent = colors[pickedSquare];
		squares[pickedSquare].classList.add("picked");
		gameOver = false;
		changeHeadColor("#232323");
		changeStatusDisplay("");
	})
}

function coverSquare(squares){
	for(var i=3;i<6;i++){
		squares[i].style.background = "#232323";
	}

}