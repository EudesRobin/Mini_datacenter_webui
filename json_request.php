<?php
function json_request($url){

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);

curl_close($ch);

return json_decode($result,true);
}

function json_post(){

$data = array("resource" => "/nodes=1,walltime=00:10:00", "command" => "sleep 600");
$data_string = json_encode($data);

$ch = curl_init('http://docker:docker@localhost/oarapi-priv/jobs.json');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));

$result = curl_exec($ch);

curl_close($ch);
return json_decode($result,true);

}

?>
