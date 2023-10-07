<?php
        
    //CONSTANTS
    echo "<h2>constant() function example<br></h2>";

    define("MINSIZE", 50);
    echo MINSIZE;
    echo constant("MINSIZE"); // same thing as the previous line



    //CONSTANTS
    echo "<h2>VALID AND INVALID CONSTANT NAMES<br></h2>";

    // Valid constant names
    define("ONE", "first thing");
    define("TWO2", "second thing");
    define("THREE_3", "third thing");
    echo "No integer, special characters, on the first in the name";

    // Invalid constant names
    //define("2TWO", "second thing");
    //define("__THREE__", "third value"); 



?>