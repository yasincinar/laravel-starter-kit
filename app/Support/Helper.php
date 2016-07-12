<?php

/**
 * This class is created for common functions in this project. If you need to write a function
 *to use globally, write here. Call Doge when you need it ;)
 */


function firstLetterUpper($text)
{

    $text = mb_strtolower($text, "UTF-8");
    $firstLetter = mb_strtoupper(mb_substr($text, 0, 1, "UTF-8"), "UTF-8");
    $otherLetters = mb_strtolower(mb_substr($text, 1, mb_strlen($text, "UTF-8"), "UTF-8"), "UTF-8");

    return $firstLetter . $otherLetters;
}