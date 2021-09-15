<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];


$queryUrl = 'https://b24-x18kac.bitrix24.ru/rest/1/s16zvj6vs0r4h672/crm.lead.add.json';


$queryData = http_build_query(array(
    'fields' => array(
        'TITLE' => 'Lead Title',
        'NAME' => $name,
        'EMAIL' => array(
            "n0" => array(
                "VALUE" => "$email",
                "VALUE_TYPE" => "WORK",
            ),
        ),
        'PHONE' => array(
            "n0" => array(
                "VALUE" => "$phone",
                "VALUE_TYPE" => "WORK",
            ),
        ),
    ),
    'params' => array("REGISTER_SONET_EVENT" => "Y")
));


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $queryUrl,
    CURLOPT_POSTFIELDS => $queryData,
));

$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, 1);

if (array_key_exists('error', $result))
    echo "Error: " . $result['error_description'] . "<br/>";
else
    echo "Success";
