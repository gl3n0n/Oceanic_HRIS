<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://104.156.53.150/oceanic/api/notifications.php");
curl_setopt($ch, CURLOPT_POST, 1);

//array('postvar1' =&amp;gt; 'value1') here you can send your parameters

curl_setopt($ch, CURLOPT_POSTFIELDS, 
         http_build_query(array('org_id' => '1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

echo "SErver outout::" . $server_output;

?>
