<?php
    
    
    function islocal()
    {
        
        if ((substr($_SERVER['REMOTE_ADDR'],0,8) == "192.168.") || ($_SERVER['REMOTE_ADDR'] == "127.0.0.1"))
            return true;
        else
            return false;
        
    }
    
 
    if(!islocal())
        exit("Security error");
    
    
    $output = file('/var/log/apache2/access_log');
    

    

    ?>
<title>Apache Logs</title>
<style>
html {
    font-family:monospace;
}
.tbl {
    table-layout:fixed;
    border-top: 5px solid #333;
    border-collapse: collapse;
background: #fff;
width:100%;
}
.tbl td {
    border-bottom: 1px dashed #333;
padding: 2px 5px;
word-wrap: break-word;
}
</style>
<pre><?php// echo $output ?></pre>
<table class="tbl" border="1" style='font-family:sans-serif;'>
<tr>
<th width="150px">IP</th>
<th width="240px">Date</th>
<th width="500px">Request</th>
<th >Result</th>
</tr>
<?
foreach(array_reverse($output) as $line) {
    $linearray = explode(" ", $line);
     $array2= explode('"', $line);
    
    $domain = $linearray[0];
    $ip = $linearray[1];
    $date = $linearray[3] . $linearray[4];
    $request = $array2[1];
    $useragent = $array2[5];
    $result =explode(" ",$array2[2])[1];
 //   var_dump($linearray);
   // var_dump($array2);
    $style = "";
    if ($ip == $me) $style = " style='background:yellow;'";
    elseif ($ip == $self) $style = " style='color:grey;background:silver;'";
    elseif ($linearray[6] == '"POST') $style = " style='background:pink;'";
    ?>
    <tr<?=$style?>>
    <td><?=$domain?></td>
    <td><?=$date?></td>
    <td><?=$request?></td>
    <td><?=$result?></td>

    </tr>
    <?
}
?>
</table>

