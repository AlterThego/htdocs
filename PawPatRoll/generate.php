<?php

require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

$text = $_POST["text"];

// Check if the provided text starts with "http://" or "https://"
if (strpos($text, "http://") !== 0 && strpos($text, "https://") !== 0) {
    // If not, add "http://" at the beginning
    $text = "http://" . $text;
}

$qr_code = QrCode::create($text)
                 ->setSize(600)
                 ->setMargin(40)
                 ->setForegroundColor(new Color(0, 0, 0))
                 ->setBackgroundColor(new Color(255, 255, 255));

$label = Label::create("21-4129-891")
              ->setTextColor(new Color(0, 0, 0));

$logo = Logo::create("pawpatroll_logo.png")
            ->setResizeToWidth(150);

$writer = new PngWriter;

$result = $writer->write($qr_code, logo: $logo, label: $label);

// Output the QR code image to the browser
header("Content-Type: " . $result->getMimeType());

echo $result->getString();

// Save the image to a file
//$result->saveToFile("qr-code.png");
