<?php

$key = $_POST["key"];
if(isset($key)){


	function getContent($url){
        if(ini_get('allow_url_fopen') == true){

        	$context = stream_context_create(array('http' => array( 'timeout' => 600)));
            $result = file_get_contents($url,false,$context);

        } else if(function_exists('curl_init')) {

            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_HEADER,0);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,600);
            curl_setopt($curl,CURLOPT_TIMEOUT,60);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            $result = curl_exec($curl);
            curl_close($curl);

        } else {
            throw new Exception("ERROR");
        }

        return $result;
    }

	$url = 'http://api.e-goi.com/v2/rest.php?type=json&method=getClientData&'.http_build_query(array('functionOptions' => array('apikey' => $key)),'','&');
       	$result_client = json_decode(getContent($url));

        /*if($result_client->Egoi_Api->getClientData->response=='INVALID'){
        	header('HTTP/1.1 404 Not Found');
			exit;
        }else{*/
        	echo "SUCCESS";
        //}
}else{
	header('HTTP/1.1 403 Forbidden');
	exit;
}

exit;