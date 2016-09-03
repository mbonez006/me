/*
* This javascript file contains variables and functions of the zomb goalie football game.
* The functions contained in this file particularly deals with the initialisation, starting
* and ending of the game.
*/

var canv_init = document.getElementById("bg");
var ctx_init = canv_init.getContext("2d");

var canv = document.getElementById("game");
canv.addEventListener("mousemove", seenmotion,false);

var ctx = canv.getContext("2d");

// seting up the request animation frame variable to handle multiple browsers
window.requestAnimFrame = (function () {
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          function( callback ){
            window.setTimeout(callback, 50);
          };
})();

var cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame || window.webkitCancelAnimationFrame ||function(callback) {
            clearTimeout(callback);
        };

// Variables needed for the game
var mouse_position = new Object();
var z = 0;
var myReq;
var paused = false;
var collided = 0;
var prevPlayer;
var nextPlayer = 1;
var currentPlayer = 0;
var shoot = Math.floor(Math.random()*3);
var direction = 99;
var goals= 5;
var saves = 0;
var level = 1;
var gameOver = false;
var points = 0;
var audio;
var first_touch = false;
var first_launch = true;
var sound_status = true;
//var accel = new Accel();

//handling scores
var scores = new Array();

// Goal Post
var post_x = 270;
var post_y = 0;

//Players
var player1 = new Object();
player1.x_pos = 50;
player1.y_pos = 350;

var player2 = new Object();
player2.x_pos = 470;
player2.y_pos = 470;

var player3 = new Object();
player3.x_pos = 850;
player3.y_pos = 350;

// GoalKeeper
var goal_keeper = new Object();
goal_keeper.x_pos = 450;
goal_keeper.y_pos = 50;
goal_keeper.speed = 20;
    
//Ball
var ball = new Object();
ball.x_pos = 100;
ball.y_pos = 400;

//crowd
var crowd = new Object();
crowd.y_pos = 550;
crowd.height = 50;

// a = multiples of 1, b = multiples of 3
var ballSpeed = new Object();
ballSpeed.a = 2;
ballSpeed.b = 6;

back = ctx.getImageData(0, 0, 50, 50);

function load_game() {
    myReq = requestAnimFrame(start_game);
}


function initialise_all_global_variables(){
    
	///////////
	paused = false;
    myReq = 0;
	collided = 0;
	nextPlayer = 1;
	currentPlayer = 0;
	shoot = Math.floor(Math.random()*3);
	direction = 99;
	goals= 5;
	saves = 0;
	level = 1;
	gameOver = false;
	points = 0;
	audio;
	first_touch = false;
	first_launch = false;
    sound_status = true;
    
    
	// Goal Post
	post_x = 270;
	post_y = 0;
	
	//Players
	player1.x_pos = 50;
	player1.y_pos = 350;
	
	player2.x_pos = 470;
	player2.y_pos = 470;
	
	player3.x_pos = 850;
	player3.y_pos = 350;
	
	// GoalKeeper
	goal_keeper.x_pos = 450;
	goal_keeper.y_pos = 50;
	goal_keeper.speed = 20;
	
	//Ball
	ball.x_pos = 100;
	ball.y_pos = 400;
    
    //crowd
    crowd.y_pos = 550;
    crowd.height = 50;
	
	// a = multiples of 1, b = multiples of 3
	ballSpeed.a = 2;
	ballSpeed.b = 6;
}


//Function that sets the game up, drawing the game logo 
//and calling functions that monitor mouse clicks
function preload_game(){
    
    //getting score details from local storage
    if(first_launch == true && localStorage.getItem("launched") == null){
        if (typeof(Storage) != "undefined")
        {
            // Store
            localStorage["the_scores"] = JSON.stringify(scores);
            localStorage.setItem("launched", true);
        }
    }
    
    scores = JSON.parse(localStorage["the_scores"]);
    z = scores.length;
    
    cx = 500;
    cy = 500;
    
    ctx.fillStyle = '#E6D5D1';
    ctx.fillRect(0, 0, 1000, 350);
    ctx.fillStyle = '#5C5554';
    ctx.fillRect(0, 350, 1000, 350);

    //draw logo
    var img ="images/logo.png";
    draw_image(330,120,450,100,img);
    var img ="images/ball_logo.png";
    draw_image(150,60,170,170,img);
    
    draw_rect_start_game();
    canv.addEventListener("click",seenaclick,false);
    if(window.DeviceOrientationEvent){
        window.addEventListener('deviceorientation', seenAMove,false);
    }
}


// Function that handles the ending of the game
function end_game(){

    //Drawing the menu system for the end of the game
	ctx.clearRect(0,0,canv.width,canv.height);
    ctx.font="bold 50px sans-serif";
    ctx.fillStyle = "red";
    ctx.fillText("GAME OVER", 400, 300);
    ctx.font="bold 40px sans-serif";
    ctx.fillStyle = "yellow";
    ctx.fillText("Total Point = " + points, 390, 380);

    //assign the score to array of points
    scores[z] = points;

    //Storing the score array into local storage
    if (typeof(Storage) != "undefined")
    {
      // Store
        localStorage["the_scores"] = JSON.stringify(scores);
    }

    z++;

    //signify game over
    gameOver = true;
    
    ctx.fillStyle="red";
    ctx.fillRect(0,0,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Play Again", 30, 45);

    ctx.fillStyle="green";
    ctx.fillRect(0,100,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Highscore", 30, 150);

    //Drawing the sound toggling image
    toggle_sound();
    
    canv_init = canv_init;

    //stopping the animation
    window.cancelAnimationFrame(myReq);
}

/*
Function that controls the game navigation based on user's mouse click
*/

function seenaclick(e){ 
    //Check if the user is clicking an area of the page to toggle sound and hence setting
    // the status of the sound
    
    if(hitArea(e).x >= canv.width - 50 && hitArea(e).x < canv.width && hitArea(e).y > 0 && hitArea(e).y < 50){
        if(sound_status == true){
            sound_status = false;
        }
        else{
            sound_status = true;
        }
    }

    if(gameOver == false){
        //where r = red, b = blue, y = yellow and g = green
		if(hitpaint(e) == "r"){
	        canv.width=canv.width;
            
	        load_game();
	    }
	    else if(hitpaint(e) == "b"){
	        // clear rectangle and display help
	        canv.width=canv.width;
	
	        display_help();
	    }
	    else if(hitpaint(e) == "y"){
	        // clear rectangle and display "about"
	        canv.width=canv.width;
	        display_about();
	    }
        else if(hitpaint(e) == "g"){
	        // clear rectangle and display highscore
            
	        canv.width=canv.width;
	        display_highscore();
	    }
    }
    else{
        // if the game is over?
        //where r = red, b = blue, y = yellow and g = green
        
		if(hitpaint(e) == "r"){
			preload_game();
			gameOver = 0;
			initialise_all_global_variables();
	    }
	    else if(hitpaint(e) == "g"){
	        // clear rectangle and start game
	        canv.width=canv.width;
	        display_highscore();
	    }
	    else if(hitpaint(e) == "y"){
	        // clear rectangle and start game
	        canv.width=canv.width;
	        display_about();
	    }
        else if(hitpaint(e) == "b"){
	        // clear rectangle and start game
	        canv.width=canv.width;
	        display_help();
	    }
    }
}

/*
Function that displays an image of the sound status of the game
*/
function toggle_sound(){
    var img_src1 ="images/sound_on.png";
    var img_src2 ="images/sound_off.png";
    
    if(sound_status == true){
        draw_image2(canv.width - 50,0,50,50,img_src1);
    }
    else{
        draw_image2(canv.width - 50,0,50,50,img_src2);
    }
}