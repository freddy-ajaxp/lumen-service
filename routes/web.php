<?php
use GuzzleHttp\Client;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/create-notification', function () use ($router) {

    function sendMessage()
    {
        $content      = array(
            "message" => 'Anda Mendapat Notifikai Baru'
        );
        $hashes_array = array();
        //ini akan muncul di chrome saja, karena itu dicomment
        // array_push($hashes_array, array(
        //     "id" => "like-button",
        //     "text" => "Like",
        //     "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //     "url" => "https://yoursite.com"
        // ));
        // array_push($hashes_array, array(
        //     "id" => "like-button-2",
        //     "text" => "Like2",
        //     "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //     "url" => "https://yoursite.com"
        // ));
        $fields = array(
            'app_id' => "ce59b4a5-0a9a-4f27-afe4-1d82f73d2239",
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            // 'url' => $url,
            'contents' => $content,
            'web_buttons' => $hashes_array
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        //dengan curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZjgzYWI0YTMtNjYyZC00NmJmLWI0NmItMzkzODcyNWNmMTFl'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);


        //dengan guzzle
        //dengan guzzle
        // $client = new Client( );
        // $response = $client->request('GET', 'https://onesignal.com/api/v1/notifications', 
        // ['headers' => ['Content-Type' => 'application/json; charset=utf-8', 'Authorization' =>  'Basic ZjgzYWI0YTMtNjYyZC00NmJmLWI0NmItMzkzODcyNWNmMTFl'],
        // 'body' => $fields ]);
        // return $response;
        
        return $response;
    }
    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode($return);

    $data = json_decode($response, true);
    print_r($data);
    print("\n\nJSON received:\n");
    print($return);
    print("\n");
});
