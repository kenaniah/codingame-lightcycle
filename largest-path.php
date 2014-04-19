<?php
//Create the grid matrix [X][Y]
$x = 30;
$y = 20;
$grid = array_fill(0, $x, array_fill(0, $y, -1));

while (1) {
    
    //Read information from standard input
    list($n, $p) = fscanf(STDIN, "%d %d");
    
    fprintf(STDERR, "Players: $n\nMe: $p\n");
    
    //Read player information
    foreach(range(0, $n - 1) as $player):
        
        //Read the coordinates
        list($x0, $y0, $x1, $y1) = fscanf(STDIN, "%d %d %d %d");
        
        //Update the grid with the player's new position
        $grid[$x1][$y1] = $player;
        
        //Find my coordinates
        if($player == $p):
            list($my_x, $my_y) = [$x1, $y1];
            fprintf(STDERR, "My coords: ($x1, $y1)\n");
        endif;
        
    endforeach;
    
    //Find the longest direction
    $dir = [
        "UP" => 0,      //approaches 0
        "RIGHT" => 0,   //approaches $x
        "LEFT" => 0,    //approaches 0
        "DOWN" => 0     //approaches $y
    ];
    
    //Look up
    $px = $my_x;
    $py = $my_y;
    while(--$py >= 0):
        if($grid[$px][$py] != -1) break;
        $dir["UP"]++;
    endwhile;
    
    //Look down
    $px = $my_x;
    $py = $my_y;
    while(++$py < $y):
        if($grid[$px][$py] != -1) break;
        $dir["DOWN"]++;
    endwhile;
    
    //Look left
    $px = $my_x;
    $py = $my_y;
    while(--$px >= 0):
        if($grid[$px][$py] != -1) break;
        $dir["LEFT"]++;
    endwhile;
    
    //Look right
    $px = $my_x;
    $py = $my_y;
    while(++$px < $x):
        if($grid[$px][$py] != -1) break;
        $dir["RIGHT"]++;
    endwhile;
    
    fprintf(STDERR, "Lengths: " . implode(", ", $dir) . "\n");

    //Determine which direction to travel
    $longest = array_keys($dir, max($dir));

    //Write action to standard output
    fprintf(STDOUT, $longest[0] . "\n");
    
    
    
}

?>