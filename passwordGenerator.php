<?php
$length = 12; 
$includeUppercase = true;
$includeNumbers = true; 
$includeSymbols = true; 

function generatePassword($length, $includeUppercase, $includeNumbers, $includeSymbols) {
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()-_=+[]{}|;:,.<>?';

    $characters = $lowercase;
    if ($includeUppercase) {
        $characters .= $uppercase;
    }
    if ($includeNumbers) {
        $characters .= $numbers;
    }
    if ($includeSymbols) {
        $characters .= $symbols;
    }

    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $password;
}

$password = generatePassword($length, $includeUppercase, $includeNumbers, $includeSymbols);
echo "Generated Password: $password\n";
