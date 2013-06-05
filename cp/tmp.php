<?php

$v = "sun,mon,tue";
$a = explode(',', $v);

for($i=0;$i<count($a);$i++)
	echo $a[$i]."\n";
