<?php

function Using($name, $var = [])
{
    $component = "components/$name.php";

    $var = $var;

    if (file_exists($component)) {
        include $component;
    }
}
