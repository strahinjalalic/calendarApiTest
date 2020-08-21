<?php

namespace App;

use Google_Client;
use Google_Service_Calendar;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    public function getClient()
{
    $client = new Google_Client();

    if (!file_exists(config('google.client_path'))) {
        throw new \Exception(
            'You have not create client for application.'
            .' Please create on "console.google.com" and save to your storage "storage/google/credentials.json"!'
        );
    }

    $client->setAuthConfig(config('google.client_path'));
    $client->setAccessType('offline');

    $credentialsPath = config('google.token_path');
    if (!file_exists($credentialsPath)) {
        throw new \Exception('Do not receive access token. Please run command "php artisan google:get-token" to get token!');
    }

    $accessToken = json_decode(file_get_contents($credentialsPath), true);
    $client->setAccessToken($accessToken);

    if($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }

    return $client;


    // $client = new Google_Client();
    // $client->setApplicationName('Google Calendar Test');
    // $client->setScopes(Google_Service_Calendar::CALENDAR);
    // $client->setAuthConfig('oauth_credentials.json');
    // $client->setAccessType('offline');
    // $client->setPrompt('select_account consent');

    // $tokenPath = 'token.json';
    // if (file_exists($tokenPath)) {
    //     $accessToken = json_decode(file_get_contents($tokenPath), true);
    //     $client->setAccessToken($accessToken);
    // }

    // if ($client->isAccessTokenExpired()) {
    //     if ($client->getRefreshToken()) {
    //         $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    //     } else {
    //         $authUrl = $client->createAuthUrl();
    //         printf("Open the following link in your browser:\n%s\n", $authUrl);
    //         print 'Enter verification code: ';
    //         $authCode = fgets(STDIN);

    //         $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    //         $client->setAccessToken($accessToken);
    //     }

    //     if (!file_exists(dirname($tokenPath))) {
    //         mkdir(dirname($tokenPath), 0700, true);
    //     }
    //     file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    // }
    // return $client;
}
}
