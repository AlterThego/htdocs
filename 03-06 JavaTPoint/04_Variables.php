
<?php
        
        //integers
        echo "<h2>INTEGERS<br></h2>";
        $int_var = 12345;
        echo "int_var = ";
        print($int_var);
        $another_int = -12345 + 12345;
        print ("<br>FORMULA: another_int = -12345 + int_var");
        echo "<br>another_int = -12345 + 12345";
        echo "<br>another_int; SUM = ",$another_int;


        //doubles
        echo "<h2>DOUBLES<br></h2>";
        $many = 2.2888800;
        $many_2 = 2.2111200;
        echo "many = ", $many;
        echo "<br>many_2 = ", $many_2;
        $few = $many + $many_2;
        print ("<br>FORMULA: few = many + many_2");
        echo "<br>few; SUM: ", $few;


        //boolean
        echo "<h2>BOOLEAN<br></h2>";
        if (TRUE)
        print("This will always print<br>");
        
        else
        print("This will never print<br>");


        //interpreting other types of boolean
        echo "<br><h2>INTERPRETING OTHER TYPES OF BOOLEAN</h2>";
        $true_str = "Tried and true";
        $true_array [49]= ("An array element");
        $false_array = array();
        $false_null = NULL;
        $false_num = 999 - 999;
        $false_str = " ";

        echo "$true_str = ", $true_str;
        echo "<br>true_array [49] = ", $true_array[49];
        //echo "<br>$false_array = ", $false_array;
        echo "<br>false_null = ", $false_null;
        echo "<br>false_num = ", $false_num;
        echo "<br>false_str = ", $false_str;


        //NULL
        echo "<br><h2>NULL</h2>";
        $my_var = NULL;
        echo "NULL", $my_var;


        //STRINGS
        $string_1 = "This is a string in double quotes";
        $string_2 = "This is a somewhat longer, singly quoted string";
        $string_39 = "This string has thirty-nine characters";
        $string_0 = " "; // a string with zero characters
        echo "<br>string_1 = " , $string_1;
        echo "<br>string_2 = " , $string_2;
        echo "<br>string_39 = " , $string_39;
        echo "<br>string_0 = " , $string_0;

        
        $variable = "name";
        $literally = '<br>My $variable will not print!';
        echo $literally;
        $literally = "<br>My $variable will print!";
        echo $literally;
        

        //HERE DOCUMENT
        echo "<br><h2>HERE DOCUMENT</h2>";
        $channel =<<<_XML_
        <channel>
        <title>04_Variables</title>
        <link>http://menu.example.com/</link>
        <br><description>Choose what to eat tonight.</description>
        </channel>
        _XML_;
        echo <<<END
        This uses the "here document" syntax to output
        multiple lines with variable interpolation. Note
        that the here document terminator must appear on a
        line with just a semicolon. no extra whitespace!
        <br />
        END;
        print $channel;

        //PHP VARIABLES
        echo "<br><h2>PHP VARIABLES</h2>";
        $test = <<<_TEST_
        <body>
            <ul>
                <li>Local Variables</li>
                <li>Function Parameters</li>
                <li>Global Variables</li>
                <li>Static Variables</li>
            </ul>
        </body>
        _TEST_;

        echo $test;

        //PHP LOCAL VARIABLES
        echo "<h2>PHP LOCAL VARIABLES</h2>";
        
        $x = 4;
        function assignx () {
        $x = 0;
        print "x inside function is $x. ";    
        }
        assignx();
        print "x outside of function is $x.";
        

        //PHP FUNCTION VARIABLES
        echo "<br><h2>PHP FUNCTION VARIABLES</h2>";

        // multiply a value by 10 and return it to the caller
        function multiply ($value) {
        $value = $value * 10;
        return $value;
        }
        $retval = multiply (10);
        Print "Return value is $retval\n";

        //PHP FUNCTION VARIABLES
        echo "<br><h2>PHP GLBOAL VARIABLES</h2>";

        $somevar = 15;
        function addit() {
        GLOBAL $somevar;
        $somevar++;
        print "Somevar is $somevar";
        }
        addit();

        //PHP STATIC VARIABLES
        echo "<br><h2>PHP GLBOAL VARIABLES</h2>";

        function keep_track() {
            STATIC $count = 0;
            $count++;
            print $count;
            print " ";
        }
        keep_track();
        keep_track();
        keep_track();






?>
        
