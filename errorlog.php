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

    $output = file('/var/log/apache2/error_log');
    
    ?>
<title>Error Logs</title>
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
<th width="200px">Date</th>
<th width="50px">Error Level</th>
<th width="180px">Source</th>
<th >Result</th>
</tr>
<?
foreach(array_reverse($output) as $line) {
    $linearray = explode("[", $line);
    $errdate = explode("]",$linearray[1])[0];
    $errstatus = explode("]",$linearray[2])[0];
    $source = explode("]",$linearray[3])[0];
    
    
    $index=0;
    $result="";
    $linearray = explode("]", $line);

    foreach($linearray as $squaredelimited)
    {
     if($index>2)
     {
         $result = $result . $squaredelimited;
     }
    
    
         $index++;
    }
    


 //   var_dump($linearray);
   // var_dump($array2);
    $style = "";
    ?>
    <tr<?=$style?>>
    <td><?=$errdate?></td>
    <td><?=$errstatus?></td>
    <td><?=$source?></td>
    <td><?=$result?></td>

    </tr>
    <?
}
?>
</table>
