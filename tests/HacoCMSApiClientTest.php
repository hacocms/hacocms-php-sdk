<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HacoCMS\V1\HacoCMSApiClient;

final class HacoCMSApiClientTest extends TestCase
{
    public function testBuildApiUrl()
    {
        $client = new HacoCMSApiClient('subdomain', 'access token');
        $apiUrl = $client->buildApiUrl('test');
        $this->assertEquals($apiUrl, 'https://subdomain.hacocms.com/api/v1/test');

        $apiUrl = $client->buildApiUrl('test', 'IDid');
        $this->assertEquals($apiUrl, 'https://subdomain.hacocms.com/api/v1/test/IDid');
   }

    /**
     * public function testHacoCMSApiClient()
     * {
     *     $client = new HacoCMSApiClient('subdomain', 'access token');
     *     $res = $client->list('endpoint');
     *     $this->assertNotNull($res);
     *
     *     $res = $client->listSingleContent('endpoint', 'content_id');
     *     $this->assertNotNull($res);
     *
     *     $res = $client->single('endpoint');
     *     $this->assertNotNull($res);
     * }
     */
}
