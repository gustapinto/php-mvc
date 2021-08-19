<?php

namespace Framework\Helpers;

class Redirector
{
    public static function redirect(string $url)
    {
        return header('Location: ' . $url, TRUE);
    }
}
