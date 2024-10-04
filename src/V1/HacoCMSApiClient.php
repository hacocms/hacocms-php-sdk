<?php
namespace HacoCMS\V1;

use GuzzleHttp\Client as GuzzleHttpClient;

class HacoCMSApiClient
{
    private $subdomain;
    private $accessToken;
    private $projectDraftToken;
    private $httpClient;

    function __construct(string $subdomain, string $accessToken, string $projectDraftToken = null)
    {
        $this->subdomain = $subdomain;
        $this->accessToken = $accessToken;
        $this->projectDraftToken = $projectDraftToken;
        $this->httpClient = new GuzzleHttpClient();
    }

    /**
     * リスト形式APIのコール
     * (通常)
     */
    public function list(string $endpoint, array $query = [])
    {
        $apiUrl = $this->buildApiUrl($endpoint);
        return $this->callApi($apiUrl, $query);
    }

    /**
     * リスト形式APIのコール
     * (dataのみ)
     */
    public function listData(string $endpoint, array $query = [])
    {
        $list = $this->list($endpoint, $query);
        return !empty($list['data']) ? $list['data'] : [];
    }

    /**
     * リスト形式APIのコール
     * (リスト内の単一コンテンツを取得する)
     */
    public function listSingleContent(string $endpoint, string $contentId, array $query = [])
    {
        $apiUrl = $this->buildApiUrl($endpoint, $contentId);
        return $this->callApi($apiUrl, $query);
    }

    /**
     * シングル形式APIのコール
     */
    public function single(string $endpoint, array $query = [])
    {
        $apiUrl = $this->buildApiUrl($endpoint);
        return $this->callApi($apiUrl, $query);
    }

    /**
     * APIのURLを組み立てる
     */
    public function buildApiUrl(string $endpoint, string $contentId = null)
    {
        if (is_null($contentId)) {
            return sprintf('https://%s.hacocms.com/api/v1/%s', $this->subdomain, $endpoint);
        }
        return sprintf('https://%s.hacocms.com/api/v1/%s/%s', $this->subdomain, $endpoint, $contentId);
    }

    /**
     * APIコールの内部関数
     */
    private function callApi(string $apiUrl, array $query)
    {
        $headers = ['Authorization' => 'Bearer ' . $this->accessToken];

        if ($this->projectDraftToken) {
            $headers['Haco-Project-Draft-Token'] = $this->projectDraftToken;
        }

        $response = $this->httpClient->request('GET', $apiUrl, [
            'headers' => $headers,
            //'http_errors' => false,

            // https://docs.guzzlephp.org/en/stable/quickstart.html#query-string-parameters
            'query' => $query ?: '',
        ]);

        $json = $response->getBody()->getContents();

        // JSONデコードに失敗したら、例外をスローさせます
        // SEE: https://www.php.net/manual/ja/function.json-decode.php
        return json_decode($json, /* $associative = */ true, /*  $depth = */ 512, /*  $flags = */ JSON_THROW_ON_ERROR);
    }
}
