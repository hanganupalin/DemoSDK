<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 08:36
 */

$clinet = new \GuzzleHttp\Client();

$respons = $clinet->request('GET',
    'https://packagist.org/search.json',
    [
        'query' => ['q' => SdkRestApi::getParam('packagist_query')]
    ]
);
return json_decode($res->getBody(), true);
