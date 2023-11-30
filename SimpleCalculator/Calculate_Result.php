<!DOCTYPE html>
<html>
<head>
    <title>Basic Calculator - Result</title>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operation = $_POST["operation"];
    
    if (!is_numeric($num1) || !is_numeric($num2)) {
        echo "Error: Please enter valid numbers.";
        exit();
    }

    if ($operation == "add") {
        $result = $num1 + $num2;
        $symbol = "+";
    } elseif ($operation == "subtract") {
        $result = $num1 - $num2;
        $symbol = "-";
    } elseif ($operation == "multiply") {
        $result = $num1 * $num2;
        $symbol = "*";
    } elseif ($operation == "divide") {
        if ($num2 != 0) {
            $result = $num1 / $num2;
        } else {
            $result = "Error: Division by zero!";
        }
        $symbol = "/";
    } else {`
        $result = "Invalid operation";
    }

    echo "Result: $num1 $symbol $num2 = $result";
}


?>
