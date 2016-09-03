/*
This file contains the function that represents the main game.
*/

// Function that starts the game, hence calling other functions
function start_game(){
    
    //clearing the canvas rectangle and calling the next animatuion frame
    ctx.clearRect(0,0,canv.width,canv.height);
    myReq = requestAnimFrame(start_game);

    //Drawing on the canvas
    paint_background();
    toggle_sound();
    if(level == 1){
        draw_watching_crowd();
    }
    else if(level == 2){
        crowd.y_pos = 500;
        crowd.height = 100;
        draw_watching_crowd();
    }
    else if(level >= 3){
        crowd.y_pos = 450;
        crowd.height = 150;
        draw_watching_crowd();
    }
    
    draw18box();
    draw_hockey_goalKeeper();
    draw_ball();
    draw_players();
    display_scoreBoard();
    
    if(gameOver == true){
        end_game();
    }
    else {
        // Pass to second player
        if (currentPlayer == 0) {
            if (shoot == 0 || shoot == 1) {
                // Pass to Player 2
                if (nextPlayer == 1) {
                    prevPlayer = 0;
                    if(first_touch == false){
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        first_touch = true;
                    }
                    pass_player1_to_player2();
                    
                    if (check_collision(player2.x_pos, player2.y_pos)) {
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        currentPlayer = nextPlayer;
                        generate_nextplayerID();

                        shoot = Math.floor(Math.random() * 3);
                    }
                    
                } //Player 1 Pass the ball to player 3
                else if (nextPlayer == 2) {
                    prevPlayer = 0;
                    pass_player1_to_player3();

                    //once the ball collides with another player, generate the next player
                    if (check_collision(player3.x_pos, player3.y_pos)) {
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        currentPlayer = nextPlayer;
                        generate_nextplayerID();
                        shoot = Math.floor(Math.random() * 3);
                    }
                }
                
            } //player 1 should shoot if shoot is = '2' for the possible 0,1 or 2 that it could be (design decision)
            else if (shoot == 2) {
                if(first_touch == false){
                    if(sound_status == true){
                        play_sound("ball_sound.wav");
                    }
                    first_touch = true;
                }
                //decide what direction the ball should be shot at out of a possible 3 direction
                if (direction == 99) {
                    direction = Math.floor(Math.random() * 3);
                }

                if (direction == 0) {
                    player1_shoot_left();
                }
                else if (direction == 1) {
                    player1_shoot_centre();
                }
                else if (direction == 2) {
                    player1_shoot_right();
                }

                //GK catches the ball
                if (check_collision(goal_keeper.x_pos, 50)) {
                    currentPlayer = 0;
                    nextPlayer = 1;
                    
                    //setting the scores and counters
                    saves++;
                    points += 6;

                    if (saves == 20) {
                        saves = 0;

                        level++;

                        if (level == 2) {
                            change_to_level2();
                        }
                        else if (level >= 3) {
                            change_to_level3();
                        }
                    }
                    else {
                        if (level == 1) {
                            ball.y_pos = 400;
                            ball.x_pos = 100;
                        }
                        else if (level == 2) {

                            ball.y_pos = 300;
                            ball.x_pos = 100;
                        }
                        else if (level >= 3) {
                            ball.y_pos = 250;
                            ball.x_pos = 100;
                        }
                    }
                    direction = 99;
                    shoot = Math.floor(Math.random() * 3);
                }


                //The player scoresss!!!
                if (ball.y_pos < 50) {
                    if (ball.x_pos >= 275 && ball.x_pos <= 610 && ball.y_pos) {
                        if(sound_status == true){
                            play_sound("whistle.wav");
                        }
                        display_goal();

                        //reset the ball to the first player
                        currentPlayer = 0;
                        nextPlayer = 1;

                        if (level == 1) {
                            ball.y_pos = 400;
                            ball.x_pos = 100;
                        }
                        else if (level == 2) {

                            ball.y_pos = 300;
                            ball.x_pos = 100;
                        }
                        else if (level >= 3) {
                            ball.y_pos = 250;
                            ball.x_pos = 100;
                        }


                        direction = 99;
                        shoot = Math.floor(Math.random() * 3);
                        if (goals >= 0) {
                            goals--;
                        }
                        
                        //Game over if the amount of possible goals 
                        if (goals <= 0) {
                            gameOver = true;
                            end_game();
                            
                            if(sound_status == true){
                                play_sound("tune.m4a");
                            }
                        }
                    }
                }

            }
        }
        else if (currentPlayer == 1) {
            if (shoot == 0 || shoot == 1) {
                // Pass to Player 2
                if (nextPlayer == 0) {
                    prevPlayer = 1;
                    pass_player2_to_player1();

                    if (check_collision(player1.x_pos, player1.y_pos)) {
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        currentPlayer = nextPlayer;
                        generate_nextplayerID();
                        shoot = Math.floor(Math.random() * 3);
                        first_touch = false;
                    }
                }//Player 2 Pass the ball to player 3
                else if (nextPlayer == 2) {
                    prevPlayer = 1;
                    pass_player2_to_player3();

                    if (check_collision(player3.x_pos, player3.y_pos)) {
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        currentPlayer = nextPlayer;
                        generate_nextplayerID();
                        shoot = Math.floor(Math.random() * 3);
                        first_touch = false;
                    }
                }
            }// then shoot is 2, so SHOOT the ball!!
            else if (shoot == 2) {

                if (direction == 99) {
                    direction = Math.floor(Math.random() * 3);
                }

                //control the direction to shoot the ball to
                if (direction == 0) {
                    player2_shoot_left();
                }
                else if (direction == 1) {
                    player2_shoot_centre();
                }
                else if (direction == 2) {
                    player2_shoot_right();
                }

                //GK catches the ball
                if (check_collision(goal_keeper.x_pos, 50)) {
                    currentPlayer = 0;
                    nextPlayer = 1;

                    //set the counters and scores
                    saves++;
                    points += 6;

                    //control level depending on the number of saves made
                    if (saves == 20) {
                        saves = 0;

                        level++;

                        if (level == 2) {
                            change_to_level2();
                        }
                        else if (level >= 3) {
                            change_to_level3();
                        }
                    }
                    //resetting ball positions
                    else {
                        if (level == 1) {
                            ball.y_pos = 400;
                            ball.x_pos = 100;
                        }
                        else if (level == 2) {

                            ball.y_pos = 300;
                            ball.x_pos = 100;
                        }
                        else if (level >= 3) {
                            ball.y_pos = 250;
                            ball.x_pos = 100;
                        }
                    }

                    direction = 99;
                    shoot = Math.floor(Math.random() * 3);
                    first_touch = false;
                }


                //The player scoresss!!!
                if (ball.y_pos < 50) {
                    if (ball.x_pos >= 275 && ball.x_pos <= 610) {
                        if(sound_status == true){
                            play_sound("whistle.wav");
                        }
                        display_goal();

                        currentPlayer = 0;
                        nextPlayer = 1;

                        if (goals >= 0) {
                            goals--;
                        }

                        if (goals <= 0) {
                            end_game();
                            if(sound_status == true){
                                play_sound("tune.m4a");
                            }
                            gameOver = true;
                        }
                        
                        //resetting original ball position
                        if (level == 1) {
                            ball.y_pos = 400;
                            ball.x_pos = 100;
                        }
                        else if (level == 2) {

                            ball.y_pos = 300;
                            ball.x_pos = 100;
                        }
                        else if (level >= 3) {
                            ball.y_pos = 250;
                            ball.x_pos = 100;
                        }

                        direction = 99;
                        shoot = Math.floor(Math.random() * 3);
                        first_touch = false;
                    }
                }

            }
        }
        else if (currentPlayer == 2) {
            if (shoot == 0 || shoot == 1) {
                // Pass to Player 2
                if (nextPlayer == 0) {
                    prevPlayer = 2;
                    pass_player3_to_player1();

                    if (check_collision(player1.x_pos, player1.y_pos)) {
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        currentPlayer = nextPlayer;
                        generate_nextplayerID();

                        shoot = Math.floor(Math.random() * 3);
                        first_touch = false;
                    }
                }//Player 3 Pass the ball to player 2
                else if (nextPlayer == 1) {
                    prevPlayer = 2;
                    pass_player3_to_player2();

                    if (check_collision(player2.x_pos, player2.y_pos)) {
                        if(sound_status == true){
                            play_sound("ball_sound.wav");
                        }
                        currentPlayer = nextPlayer;
                        generate_nextplayerID();

                        shoot = Math.floor(Math.random() * 3);
                        first_touch = false;
                    }
                }
            }//player 2 can shoot
            else if (shoot == 2) {
                if (direction == 99) {
                    direction = Math.floor(Math.random() * 3);
                }
                
                
                //shooting to appropriate direction
                if (direction == 0) {
                    player3_shoot_left();
                }
                else if (direction == 1) {
                    player3_shoot_centre();
                }
                else if (direction == 2) {
                    player3_shoot_right();
                }

                //GK catches the ball
                if (check_collision(goal_keeper.x_pos, 50)) {
                    currentPlayer = 0;
                    nextPlayer = 1;
                    
                    //setting the counter and scores
                    saves++;
                    points += 6;

                    //changing levels based on the number of saves made
                    if (saves == 20) {
                        saves = 0;

                        level++;

                        if (level == 2) {
                            change_to_level2();
                        }
                        else if (level >= 3) {
                            change_to_level3();
                        }
                    }
                    else { //resetting ball position
                        if (level == 1) {
                            ball.y_pos = 400;
                            ball.x_pos = 100;
                        }
                        else if (level == 2) {

                            ball.y_pos = 300;
                            ball.x_pos = 100;
                        }
                        else if (level >= 3) {
                            ball.y_pos = 250;
                            ball.x_pos = 100;
                        }
                    }

                    direction = 99;
                    shoot = Math.floor(Math.random() * 3);
                    first_touch = false;
                }


                //The player scoresss!!!
                if (ball.y_pos < 50) {
                    if (ball.x_pos >= 275 && ball.x_pos <= 610) {
                        if(sound_status == true){
                            play_sound("whistle.wav");
                        }
                        
                        display_goal();

                        currentPlayer = 0;
                        nextPlayer = 1;

                        if (goals >= 0) {
                            goals--;
                        }

                        if (goals <= 0) {
                            gameOver = true;
                            if(sound_status == true){
                                play_sound("tune.m4a");
                            }
                            end_game();
                        }

                        if (level == 1) {
                            ball.y_pos = 400;
                            ball.x_pos = 100;
                        }
                        else if (level == 2) {

                            ball.y_pos = 300;
                            ball.x_pos = 100;
                        }
                        else if (level >= 3) {
                            ball.y_pos = 250;
                            ball.x_pos = 100;
                        }
                        direction = 99;
                        shoot = Math.floor(Math.random() * 3);
                        first_touch = false;
                    }
                }

            }
        }

        //put the ball back into a proper position if it goes loose and out of canvas
        // this is done depending on the level
        if (ball.x_pos > canv.width || ball.y_pos > canv.height || ball.x_pos < 0 || ball.y_pos < 0) {
            if (level == 1) {
                if(sound_status == true){
                    play_sound("ball_sound.wav");
                }
                currentPlayer = 0;
                nextPlayer = 1;

                ball.y_pos = 400;
                ball.x_pos = 100;
            }
            else if (level == 2) {
                if(sound_status == true){
                    play_sound("ball_sound.wav");
                }
                currentPlayer = 0;
                nextPlayer = 1;

                ball.y_pos = 300;
                ball.x_pos = 100;
            }
            else if (level >= 3) {
                if(sound_status == true){
                    play_sound("ball_sound.wav");
                }
                currentPlayer = 0;
                nextPlayer = 1;
                ball.y_pos = 250;
                ball.x_pos = 100;
            }
        }
    }
}