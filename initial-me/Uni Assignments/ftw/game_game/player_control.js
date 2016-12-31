/*
JS file that contains functions that handles the controling of the zombie players in the game
*/

//function generates an id representation for the next player
function generate_nextplayerID(){
    //Generate the next player ID
    var rand =Math.floor(Math.random()*3);
    while(rand == currentPlayer){
        rand =Math.floor(Math.random()*3);
    }
    nextPlayer = rand;
}


//Collision detection function
function check_collision(player_xPos, player_yPos){
    if (ball.y_pos + 40 < player_yPos)
        return(false);
    if (ball.y_pos > player_yPos + 90)
        return(false);
    if (ball.x_pos + 40 < player_xPos)
        return(false);
    if (ball.x_pos > player_xPos + 80)
        return(false);

    return true;
}

//Functions below handles the passing of the ball from one player to another
function pass_player1_to_player2(){
    ball.x_pos = ball.x_pos + (ballSpeed.b+1);
    ball.y_pos = ball.y_pos + ballSpeed.a;
}

function pass_player2_to_player1(){
    ball.x_pos = ball.x_pos - ballSpeed.b;
    ball.y_pos = ball.y_pos - ballSpeed.a;
}

function pass_player1_to_player3(){
    ball.x_pos = ball.x_pos + (ballSpeed.b * 1.5);
}

function pass_player3_to_player1(){
    ball.x_pos = ball.x_pos - (ballSpeed.b * 1.5);
}

function pass_player2_to_player3(){
    ball.x_pos = ball.x_pos + ballSpeed.b;
    ball.y_pos = ball.y_pos - ballSpeed.a;
}

function pass_player3_to_player2(){
    ball.y_pos = ball.y_pos + ballSpeed.a;
    ball.x_pos = ball.x_pos - ballSpeed.b;
}


//The function functions handles player's shooting at the goalKeeper
//player 1
function player1_shoot_left(){
    if(level >= 3){
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 9;
        goal_keeper.speed = 40;
    }
    else if(level == 2){
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 7;
    }
    else{
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 4;
    }
    console.log("Player 1 shoots left");
}

function player1_shoot_centre() {
    if (level >= 3) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 12;
        goal_keeper.speed = 40;
    }
    else if (level == 2) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 10;
    }
    else {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 6.5;
    }
    console.log("Player 1 shoots cen");
}

function player1_shoot_right(){
    if (level >= 3) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 13.5;
        goal_keeper.speed = 40;
    }
    else if (level == 2) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 12;
    }
    else {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos + 8.5;
    }

    console.log("Player 1 shoots ri");
}

//player 2 shooting
function player2_shoot_left() {
    if (level >= 3) {
        if(prevPlayer == 0){
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos - 3.5;
        }
        else{
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos - 5.5;
        }
        goal_keeper.speed = 40;

    }
    else if (level == 2) {
        if(prevPlayer == 0){
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos - 3;
        }
        else{
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos - 5;
        }
    }
    else {
        if(prevPlayer == 0){
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos - 2.5;
        }
        else{
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos - 4;
        }
    }
    console.log("Player 2 shoots left");
}

function player2_shoot_centre(){
    ball.y_pos = ball.y_pos - (ballSpeed.b + 2);
    ball.x_pos = ball.x_pos + 1;
    
    console.log("Player 2 shoots middle");
}

function player2_shoot_right(){
    if (level >= 3) {
        if(prevPlayer == 0){
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos + 4;
        }
        else{
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos + 3.5;
        }
        goal_keeper.speed = 40;
    }
    else if (level == 2) {
        if(prevPlayer == 0){
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos + 4.5;
        }
        else{
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos + 2.5;
        }
    }
    else {
        if(prevPlayer == 0){
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos + 3.5;
        }
        else{
            ball.y_pos = ball.y_pos - 9;
            ball.x_pos = ball.x_pos + 2;
        }
    }

    console.log("Player 2 shoots right");
}


//player 3 shooting
function player3_shoot_left() {
    if (level >= 3) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 13;
        goal_keeper.speed = 40;
    }
    else if (level == 2) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 12;
    }
    else {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 8.5;
    }
    console.log("Player 3 shoots left");
}

function player3_shoot_centre() {
    if (level >= 3) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 12;
        goal_keeper.speed = 40;
    }
    else if (level == 2) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 10;
    }
    else {
        ball.y_pos = ball.y_pos - ballSpeed.b;
        ball.x_pos = ball.x_pos - 6.5;
    }
    console.log("Player 3 shoots centre");
}

function player3_shoot_right(){
    if(level >= 3){
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - (ballSpeed.a * 5);
        goal_keeper.speed = 40;
    }
    else if (level == 2) {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 5;
    }
    else {
        ball.y_pos = ball.y_pos - 6;
        ball.x_pos = ball.x_pos - 3.5;
    }
    console.log("Player 3 shoots right");
}

//Function checks what color a mouse event hitted
function hitpaint(mouse_event) {
    // This function determines whether a mouse click
    // is on a painted part of the canvas
    // Find the bounding rectangle of the canvas
    var bounding_box=canv.getBoundingClientRect();

    // Get the mousex and mousey location on the canvas
    // from the mouse_event
    // and the canvas bounding rectangle
    var mousex=(mouse_event.clientX-bounding_box.left) *
            (canv.width/bounding_box.width);
    var mousey=(mouse_event.clientY-bounding_box.top) *
            (canv.height/bounding_box.height);
    var pixels=ctx.getImageData(mousex,mousey,1,1);

    // With pixel data...
    // 0 is red, 1 is green, 2 is blue, 3 is alpha
    // So we need to check data[3] and every fourth element in
    // data after that.

    //red
    if ( pixels.data[0] == 255 && pixels.data[1] == 0 && pixels.data[2] == 0 ){
        return "r";
    }//green
    else if(pixels.data[0] == 0 && pixels.data[1] == 128 && pixels.data[2] == 0){
        return "g";
    }//blue
    else if(pixels.data[0] == 0 && pixels.data[1] == 0 && pixels.data[2] == 255){
        return "b";
    }//yellow
    else if(pixels.data[0] == 204 && pixels.data[1] == 204 && pixels.data[2] == 0){
        return "y";
    }
}

//Function checks if a certain area of the canvas had been hit by a mouse click.
function hitArea(mouse_event) {
    // This function determines whether a mouse click
    // is on a painted part of the canvas
	
    // Find the bounding rectangle of the canvas
    var bounding_box=canv.getBoundingClientRect();

    // Get the mousex and mousey location on the canvas
    // from the mouse_event
    // and the canvas bounding rectangle
    var mousex=(mouse_event.clientX-bounding_box.left) *
            (canv.width/bounding_box.width);
    var mousey=(mouse_event.clientY-bounding_box.top) *
            (canv.height/bounding_box.height);

    mouse_position.x = mousex;
    mouse_position.y = mousey;
    
    return mouse_position;
}

//Function that handles keyboard control
document.onkeydown= function(event) {

    var keyCode;

    if(event == null)
    {
        keyCode = window.event.keyCode;
    }
    else
    {
        keyCode = event.keyCode;
    }
    console.log(keyCode);


    switch(keyCode)
    {
        //display_help (if h or H is pressed on the keyboard)
        case 72:
        case 104:
            if(paused == false) {
                ctx.save();
                window.cancelAnimationFrame(myReq);
                canv.width = canv.width;
                canv_init.width = canv_init.width;
                display_help();
                paused = true;
            }
            else if(paused == true){
                myReq = requestAnimFrame(start_game);
                canv.width = canv.width;
                canv_init.width = canv_init.width;
                ctx.restore();
                paused = false;
            }
            break;
            
        //mute or unmute (if s or S is pressed on the keyboard)            
        case 83:
        case 115:
            if(sound_status == true){
                sound_status = false
            }
            else{
                sound_status = true;
            }
            break;

        // move right
        case 39:
            move_right();
            break;

        // move left
        case 37:
            // action when pressing right key
            move_left();
            break;

        default:
            break;
    }
}

//moving the goal keeper
function move_left() {
    if(goal_keeper.x_pos >= 275){
        goal_keeper.x_pos = goal_keeper.x_pos - goal_keeper.speed;
    }
}

//moving the goal keeper
function move_right() {
    if(goal_keeper.x_pos <= 610){
        goal_keeper.x_pos = goal_keeper.x_pos + goal_keeper.speed;
    }
}

//function to check for the motion of a mouse pointer
function seenmotion(e) {
    var bounding_box=canv.getBoundingClientRect();
    var pos = (e.clientX-bounding_box.left) *
            (canv.width/bounding_box.width);
    if(pos >= 275 && pos <= 610){

        goal_keeper.x_pos =(e.clientX-bounding_box.left) *
                (canv.width/bounding_box.width);
    }
}