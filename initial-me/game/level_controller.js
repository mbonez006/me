/*
This Javascript file handles the control of levels during the game.
*/

function change_to_level2(){
    player1.y_pos = 250;
    player2.y_pos = 370;
    player3.y_pos = 250;
    ball.y_pos = 300;
    
    ballSpeed.a = 2.5;
    ballSpeed.b = 8;
}

function change_to_level3(){
    player1.y_pos = 200;
    player2.y_pos = 320;
    player3.y_pos = 200;
    ball.y_pos = 250;
    ballSpeed.a = 2.5;
    ballSpeed.b = 8;
}
