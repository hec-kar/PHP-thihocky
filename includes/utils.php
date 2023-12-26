<?php
function getMd5($input)
{
    try {
        // MD5 hashing
        $hash = md5($input);

        return $hash;
    } catch (Exception $e) {
        throw new RuntimeException($e);
    }
}
