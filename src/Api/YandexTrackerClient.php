<?php

namespace Nikolai\A25TestAssignment\Api;

use GuzzleHttp\Client;

class YandexTrackerClient
{
    public function getTasks()
    {
        $client = new Client();
        $client->request('GET', 'https://api.tracker.yandex.net/v3/issues/1', [
            'headers' => [
                'Authorization' => '',
                'X-Cloud-Org-ID' => '',
            ],
        ]);
    }
}
