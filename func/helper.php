<?php


function validateString($input) {
    return preg_match('/[^a-zA-Z0-9 ]/', $input);
}