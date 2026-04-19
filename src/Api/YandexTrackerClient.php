<?php

namespace Nikolai\A25TestAssignment\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class YandexTrackerClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Authorization' => "OAuth " . $_ENV['YANDEX_TRACKER_TOKEN'],
                'X-Cloud-Org-ID' => $_ENV['YANDEX_TRACKER_ORG_ID'],
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function getTasks(array $filters): string
    {
        return $this->client->request('POST', 'https://api.tracker.yandex.net/v3/issues/_search?expand=transitions', [
            'body' => json_encode([
                'filter' => [
                    'queue' => $_ENV['YANDEX_TRACKER_QUEUE'],
                    'status' => $filters['statuses'],
                    'dueDate' => $filters['due_date'],
                    '69dfd07f4af983738cc3ae4b--evaluation' => [
                        'from' => $filters['evaluation_from'],
                        'to' => $filters['evaluation_to'],
                    ],
                    '69dfd07f4af983738cc3ae4b--actualHours' => $filters['actual_hours'],
                ],
            ]),
        ])->getBody()->getContents();
    }
}
