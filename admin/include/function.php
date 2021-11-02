<?php
function decryptionID($id)
{
    return  substr($id, 4, 1);
}
function encodeID($id)
{
    $randomFirst = random_int(1000, 9999);
    $randomTail =  random_int(1000, 9999);
    return $randomFirst . $id . $randomTail;
}
