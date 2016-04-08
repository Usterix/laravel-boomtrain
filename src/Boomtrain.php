<?php
namespace Usterix\LaravelBoomtrain;

use Httpful;
use GuzzleHttp;

class Boomtrain
{
    protected $clientID;
    protected $username;
    public $password;
    protected $endpoint;
    public $apiKey;

    public static $key;

    public function __construct()
    {
        $this->Authendpoint = 'https://boomtrain.auth0.com/oauth/ro';
        $this->clientID = env('BOOMTRAIN_CLIENT_ID', 'NOT_SET');
        $this->username = env('BOOMTRAIN_USERNAME', 'NOT_SET');
        $this->password = env('BOOMTRAIN_PASSWORD', 'NOT_SET');
        $this->apiKey = env('BOOMTRAIN_API_KEY', 'NOT_SET');
    }

    protected function setup()
    {
    }

    public function addPropertiesToUser(
      $email,
      Array $properties,
      Array $attributes
    ) {
        $payload = array(
          'subscriber' => array(
            "uid" => $email,
            "properties" => $properties,
            "attributes" => $attributes
          )
        );
        $response = Httpful\Request::post('https://api.boomtrain.net/201507/subscribers/identify')
          ->sendsAndExpects('application/json')
          ->basicAuth('api', $this->apiKey)
          ->body($payload)
          ->sendIt();
        if ($response->code != 200) {
            throw new \Exception($response->body->error);
        } else {
            return $response->body;
        }
    }
    

    public static function queueBoomSend($email, $properties)
    {
        self::$key = env('BOOMTRAIN_API_KEY', 'NOT_SET');
        $payload = array(
          'subscriber' => array(
            "uid" => $email,
            "properties" => $properties
          )
        );
        $process = curl_init('https://api.boomtrain.net/201507/subscribers/identify');
        curl_setopt($process, CURLOPT_HTTPHEADER,
          array('Content-Type: application/json', 'Accept:application/json'));
        curl_setopt($process, CURLOPT_HEADER, 1);
        curl_setopt($process, CURLOPT_USERPWD, 'api' . ":" . self::$key);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($process);
        curl_close($process);
        return $return;

    }
//
}




