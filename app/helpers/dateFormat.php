<?php

function DateFormat($date,$format){

    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($format);
}

?>
