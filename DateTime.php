<?php 

date_default_timezone_get("Asia/Kuching");
$CurrentTime=time();

$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
echo "$DateTime";




?>