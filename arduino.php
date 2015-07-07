<?php
$device = "COM2"; //change with your arduino COM port
exec("mode $device BAUD=9600 PARITY=n DATA=8 STOP=1 xon=off octs=off rts=on");
$comport = fopen($device, "r+b");
$tmpfname = tempnam("C:\Test result", "1_11_7"); //change with your own directory for serial write result
$handle = fopen($tmpfname, "w");
if ($comport === false){
    die("Failed opening com port<br/>");
}else{
    echo "Com Port Open<br/>";
}
do {
if ($comport) {
    while (($buffer = stream_get_line($comport, 65535)) !== false) {
        fwrite($handle, $buffer);
		echo $buffer;
		
    }
    if (!feof($comport)) {
        echo "Error: unexpected fgets() fail\n";
    }
	}
}
while (true);	
fclose($comport);
fclose($handle);
unlink($tmpfname);
?>

