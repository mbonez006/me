/*
This file contails Javascript functions that draws one thing or the other on an HTML canvas
*/

// This is a universal funtion that accepts image source and position and aims to 
// draw an image
function draw_image(x,y,width,height,img_src) {
    var img=new Image();

    img.src = img_src;
    img.onload = function(){
        ctx.drawImage(img,x,y,width,height);
    }
}

// This function also draws an image from a source, but without the "onload" call
function draw_image2(x,y,width,height,img_src) {
    var img=new Image();

    img.src = img_src;
        ctx.drawImage(img,x,y,width,height);
}

var p1;
var p2;
var p3;

//Drawing Players from a sprite
function draw_players(){
    var img ="images/zombie.png";

    p1++;
    // draw player 1
    if (p1<=20) {
        draw_image_animation(img, 0, 65, 50, 60, player1.x_pos, player1.y_pos, 80, 90);
    }
    else if (p1 > 20 && p1 <= 40) {
        draw_image_animation(img, 60, 65, 50, 60, player1.x_pos, player1.y_pos, 80, 90);
    }
    else if (p1 > 40 && p1 <= 60) {
        draw_image_animation(img, 130, 65, 45, 60, player1.x_pos, player1.y_pos, 80, 90);
    }
    else if (p1 > 60 && p1 <= 80) {
        draw_image_animation(img, 200, 65, 50, 60, player1.x_pos, player1.y_pos, 80, 90);
    }
    else{
        p1 = 0;
    }

    p2++;
    // draw player 2
    if (p2<=20) {
        draw_image_animation(img, 0, 190, 50, 60, player2.x_pos, player2.y_pos, 80, 90);
    }
    else if (p2 > 20 && p2 <= 40) {
        draw_image_animation(img, 60, 190, 50, 60, player2.x_pos, player2.y_pos, 80, 90);
    }
    else if (p2 > 40 && p2 <= 60) {
        draw_image_animation(img, 130, 190, 50, 60, player2.x_pos, player2.y_pos, 80, 90);
    }
    else if (p2 > 60 && p2 <= 80) {
        draw_image_animation(img, 200, 190, 50, 60, player2.x_pos, player2.y_pos, 80, 90);
    }
    else{
        p2 = 0;
    }

    p3++;
    // draw player 3
    if (p3<=20) {
        draw_image_animation(img, 0, 130, 50, 60, player3.x_pos, player3.y_pos, 80, 90);
    }
    else if (p3 > 20 && p3 <= 40) {
        draw_image_animation(img, 60, 130, 50, 60, player3.x_pos, player3.y_pos, 80, 90);
    }
    else if (p3 > 40 && p3 <= 60) {
        draw_image_animation(img, 130, 130, 50, 60, player3.x_pos, player3.y_pos, 80, 90);
    }
    else if (p3 > 60 && p3 <= 80) {
        draw_image_animation(img, 200, 130, 50, 60, player3.x_pos, player3.y_pos, 80, 90);
    }
    else{
        p3 = 0;
    }

}

// Drawing the menu and navigation system on the game
function draw_rect_start_game(){
    ctx.fillStyle="red";
    ctx.fillRect(130,350,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Play Game", 160, 395);

    ctx.fillStyle="blue";
    ctx.fillRect(320,350,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Help", 380, 395);

    ctx.fillStyle="#CCCC00";
    ctx.fillRect(510,350,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("About", 560, 395);

    
    ctx.fillStyle="green";
    ctx.fillRect(700,350,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("High Score", 720, 395);
}

// Function that checks for the motion of a mouse
function seenmotion(e) {
    var bounding_box=canv.getBoundingClientRect();
    var pos = (e.clientX-bounding_box.left) *
            (canv.width/bounding_box.width);
    if(pos >= 275 && pos <= 610){

        goal_keeper.x_pos =(e.clientX-bounding_box.left) *
                (canv.width/bounding_box.width);
    }
}

function draw_hockey_goalKeeper(){

    var img ="images/robot.png";
    draw_image2(goal_keeper.x_pos,50,100,100,img);
}

function draw_ball(){
    var img ="images/ball.png";
    draw_image2(ball.x_pos,ball.y_pos,40,40,img);
}

function play_sound(fn){
    audio = new Audio("sounds/" + fn); // buffers automatically when created
    audio.play();
}


function display_scoreBoard(){
    ctx.font="bold 24px sans-serif";
    ctx.fillStyle = "white";
    ctx.fillText("Goals = " + goals, canv.width-200, 25);
    ctx.fillText("Saves = " + saves + "/20", canv.width-200, 60);
    
    ctx.fillText("Level = " + level, 50, 25);
    ctx.fillStyle = "yellow";
    ctx.fillText("Total Point = " + points, 50, 60);
    
    ctx.fillStyle = "blue";
    ctx.font="bold 16px sans-serif";
    ctx.fillText("Press H for Pause/Help", 50, 90);
    ctx.fillText("Press S for Mute/Unmute", canv.width-200, 90);
}

// function that handles getting image from an image sprite
function draw_image_animation(img_src,sx,sy,swidth,sheight,x,y,width, height) {
    var img=new Image();

    img.src = img_src;
        ctx.drawImage(img,sx,sy,swidth,sheight,x,y,width,height);
}

//Function draws the background of the game on a different canvas
function paint_background(){
    var img_src ="images/grass2.jpg";

    var img=new Image();

    img.src = img_src;
    img.onload = function(){
        ctx_init.drawImage(img,0,0,canv.width,canv.height);
    }
    
    var img3 = "images/goal_post_.jpg";
    draw_image2(post_x,post_y,450,100,img3);
}

function display_highscore(){
    ctx.fillStyle="#FFE6E6";
    ctx.fillRect(0,0,1000,700);
    
    var temp;

    //sorting the scores
    for(var i = 0; i < scores.length - 1; i++){
        for(var j = 0; j < scores.length - i - 1; j++){
            if(scores[j+1] > scores[j]){
                temp = scores[j];
                scores[j] = scores[j+1];
                scores[j+1] = temp;
            }
        }
    }
    
    ctx.font = '18pt Calibri';
    ctx.fillStyle="black";
    var text = '- - - - - - - - - - - - - - - - - - - - - - - - - - YOUR SCORES - - - - - - - - - - - - - - - - - - - - - - - - - -';
    ctx.fillText(text, 80, 50);
    
    var text_space = 100;
    
    ctx.font = '16pt Calibri';
    console.log(scores.length);
    
    //print the high scores
    if(scores.length <= 10){
        for(var c = 0; c < scores.length; c++){
            ctx.fillText("Score " + (c+1)+ " ------- "+scores[c], 50, text_space);
            text_space = text_space + 30;
        }    
    }
    else{
        for(var c = 0; c < 10; c++){
            ctx.fillText("Score " + (c+1)+ " ------- "+scores[c], 50, text_space);
            text_space = text_space + 30;
        }
    }
    
    //drawing the navigating menu system on the page
    ctx.fillStyle="red";
    ctx.fillRect(0,canv.height - 80,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Play Game", 20, canv.height - 35);

    ctx.fillStyle="#CCCC00";
    ctx.fillRect(canv.width - 180,canv.height - 80,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("About", canv.width - 120, canv.height - 35);
}


function display_about(){
    ctx.fillStyle="#FFE6E6";
    ctx.fillRect(0,0,1000,700);

    var title = 'Credits';

    ctx.font = '18pt Calibri';
    ctx.fillStyle="black";
    ctx.fillText(title, 450, 50);

    var text1 = 'Game Design and Development: Olu Ashiru';
    var text2 = 'Game Sound: https://www.freesound.org/people/MentalSanityOff/sounds/218318/, David Adejumo';
    var text3 = 'PlayTesters: Solly Sob, Sarah Ashiru';
    var text4 = 'Robot GoalKeeper Image from: http://pocketscientists.com/apps/fun-steps-robots/';
    var text5 = 'Sprite image from: https://wiki.themanaworld.org/index.php/User:Fother/Pixel_Art';
    var text6 = 'Sprite Originator: Frode Lindeijer';
    var text7 = 'GoalPost image from: http://goo.gl/8WKKQ2';
    var text8 = 'Grass image from: http://bebercamp.com/perlman/teambuilding';

    ctx.font = '16pt Calibri';
    ctx.fillStyle = '#333';
    ctx.fillText(text1, 50, 80);
    ctx.fillText(text2, 50, 110);
    ctx.fillText(text3, 50, 140);
    ctx.fillText(text4, 50, 170);
    ctx.fillText(text5, 50, 200);
    ctx.fillText(text6, 50, 230);
    ctx.fillText(text7, 50, 260);
    ctx.fillText(text8, 50, 290);

    ctx.fillStyle="red";
    ctx.fillRect(0,canv.height - 80,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Play Game", 20, canv.height - 35);

    ctx.fillStyle="blue";
    ctx.fillRect(canv.width - 180,canv.height - 80,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Help", canv.width - 120, canv.height - 35);
}

function display_help(){
    ctx.fillStyle="#FFE6E6";
    ctx.fillRect(0,0,1000,700);
    
    var text0 = 'HELP PAGE';

    var text = 'The aim of the game is to prevent the 3 zombies from scoring a goal against you - the Robot Goalkeeper for as long as possible. You can move the Goalkeeper left or right to prevent the ball from going into the goal post. It\'s game over once you allow more than 5 goals into the goal post';
    
    var text2 = 'Controls: Mouse (best) \t - \t Keyboard(Left or Right Arrow keys)- \t H to Pause/Help, S to mute/unmute';
    
    var img1 = "images/robot.png";
    draw_image(100,320,100,100,img1);

    ctx.fillStyle="black";
    ctx.font = "20pt sans-serif";
    ctx.fillText(" - You",200,400);
    
    var img2 = "images/zombie.png";
    draw_image_animation(img2, 130, 260, 50, 60, 450, 320, 80, 90);
    draw_image_animation(img2, 0, 65, 50, 60, 500, 320, 80, 90);
    ctx.fillText(" - Zombies",600,400);
    
    ctx.font = "30pt sans-serif";
    wrapText(ctx, text0, 400, 50, 300, 25);
    
    ctx.font = '16pt Calibri';
    ctx.fillStyle = '#333';
    wrapText(ctx, text, 100, 100, 800, 25);
    wrapText(ctx, text2, 100, 250, 800, 25);

    //draw play game button
    ctx.fillStyle="red";
    ctx.fillRect(0,canv.height - 80,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("Play Game", 20, canv.height - 35);

    //draw about button
    ctx.fillStyle="#CCCC00";
    ctx.fillRect(canv.width - 180,canv.height - 80,180,80);

    ctx.fillStyle = "white";
    ctx.font = "20pt sans-serif";
    ctx.fillText("About", canv.width - 120, canv.height - 35);
}

function draw_watching_crowd(){
    var img_src ="images/crowd2.png";
    draw_image2(0,crowd.y_pos,1000,crowd.height,img_src);
}

 // draw 18 box around the goal post
function draw18box(){
    ctx.strokeStyle="white";
    ctx.beginPath();
    ctx.moveTo(150,100);
    ctx.lineTo(150,400);
    ctx.lineTo(850,400);
    ctx.lineTo(850,100);

    ctx.moveTo(230,100);
    ctx.lineTo(230,270);
    ctx.lineTo(780,270);
    ctx.lineTo(780,100);

    ctx.moveTo(0,100);
    ctx.lineTo(canv.width,100);
    ctx.stroke();
}

//Function used to wrap long line of text.
function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
    var words = text.split(' ');
    var line = '';

    for(var n = 0; n < words.length; n++) {
        var testLine = line + words[n] + ' ';
        var metrics = ctx.measureText(testLine);
        var testWidth = metrics.width;
        if (testWidth > maxWidth && n > 0) {
            ctx.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
        }
        else {
            line = testLine;
        }
    }
    ctx.fillText(line, x, y);
}

function display_goal() {
    ctx.font = "bold 50px sans-serif";
    ctx.fillStyle = "yellow";
    ctx.fillText("GOAL!", 400, 300);
}