<?php

function head(array $arr)
{
    return reset($arr);
}

function tail(array $arr)
{
    return end($arr);
}

function array_get(array $array, $key, $default = null)
{
    if (isset($array[$key])) {
        return $array[$key];
    }

    return $default;
}
