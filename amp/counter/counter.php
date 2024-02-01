<font face="Arial" size="2" color="#8F8F8F"><body text="#DFDFDF" bgcolor="#000000" link="#000000" alink="#000000" vlink="#000000">
<br><div align="right"><?
$dateiname1 = "countdata.dat";
$dateiname2 = "ipdata.dat";
$reloadsperre = "3600";
$userip = $REMOTE_ADDR;
$time = explode( " ", microtime());
$now = (double)$time[0] + (double)$time[1];
$alt=$now-$reloadsperre;
$neu="";
$fp = fopen($dateiname1,"r");
flock($fp, LOCK_SH);
$besucher = fgets($fp,1000);
flock($fp, LOCK_UN);
fclose($fp);
$fp2 = fopen($dateiname2,"r");
flock($fp2, LOCK_SH);
while($inhalt = fgetcsv($fp2,1000,",")) {
for($i=0;$i<count($inhalt);$i++) {
$temp=$inhalt[$i];
if($temp!="") {
$out = split("#",$temp,2);
if($out[1] < $alt) {
$neu=$neu;
} else {
$neu .= "$out[0]#$out[1],";
}
}
}
}
flock($fp2, LOCK_UN);
fclose($fp2);
if(!strstr($neu,$userip)) {
$neu .= "$userip#$now,";
$besucher++;
}
$fp = fopen($dateiname1,"w");
flock($fp, LOCK_EX);
fwrite($fp,$besucher);
flock($fp, LOCK_UN);
fclose($fp);$fp2 = fopen($dateiname2,"w");
flock($fp2, LOCK_EX);
fwrite($fp2,$neu);
flock($fp2, LOCK_UN);
fclose($fp2);
echo "$besucher";
?></div>
</body>
</font>