<?php
function obfuscatedEmail($email): string
{

    $split = explode('@', $email);

    if (sizeof($split) < 2 || $split[1] == '') {
        return '';
    }

    $firstPart         = $split[0];
    $firstPartLen      = strlen($firstPart);
    $qtyMascared       = intval(floor($firstPartLen * 0.75));
    $mascaredFirstPart = substr($firstPart, 0, -$qtyMascared) . str_repeat('*', $qtyMascared);

    $secondPart         = $split[1];
    $secondPartLen      = strlen($secondPart);
    $qtyMascared        = intval(floor($secondPartLen * 0.75));
    $mascaredSecondPart = str_repeat('*', $qtyMascared) . substr($secondPart, $qtyMascared, $secondPartLen);

    return $mascaredFirstPart . "@" . $mascaredSecondPart;
}
