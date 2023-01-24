<?php
function read_file($filepath)
{
    $file = fopen($filepath, 'r') or die('Unable to open the file!');
    $data = fread($file, filesize($filepath));
    fclose($file);
    return $data;
}
