<?php
use Philo\Blade\Blade;
function view($path, array $data = [])
{
    $view = __DIR__. '/../../resources/views';
    $cache = __DIR__. '/../../bootstrap/cache';
    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path,$data)->render();
}
function make($filename, $data)
{
    extract($data); //geeft alle variabelen uit het array data

    ob_start();//output buffering
    include(__DIR__. '/../../resources/views/emails/'. $filename);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
function slug($value){
    //remove all characters not in this list underscore Letter number or whitespace
    $value = preg_replace('![^'.preg_quote('_').'\pL\pN\s]+!u', '', mb_strtolower($value));
    //replace underscore and whitespace with a dash
    $value = preg_replace('!['.preg_quote('_').'\s]+!u', '-', $value);
    return trim($value, '-');
}