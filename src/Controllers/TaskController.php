<?php

namespace Nikolai\A25TestAssignment\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Nikolai\A25TestAssignment\Api\YandexTrackerClient;

class TaskController
{
    /**
     * @throws GuzzleException
     */
    public function tasks()
    {
        $json = new YandexTrackerClient()->getTasks($_GET);

        if (empty(json_decode($json, true))) {
            http_response_code(204);
            return json_encode([]);
        }

        return $json;
    }
}
