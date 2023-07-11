# hacoCMS-php-sdk

* https://hacocms.com/
* https://packagist.org/packages/hacocms/hacocms-php-sdk

## Install 

```sh
$ composer require hacocms/hacocms-php-sdk
```

## Usage

### Call list api

* リスト形式APIのコール

```php
$client = new HacoCMS\V1\HacoCMSApiClient('subdomain', 'access_token');
// https://[subdomain].hacocms.com/api/v1/[endpoint]
$res = $client->list('endpoint');
```

### Call listSingleContent api

* リスト形式APIのコール
* (リスト内の単一コンテンツを取得する)

```php
$client = new HacoCMS\V1\HacoCMSApiClient('subdomain', 'access_token');
// https://[subdomain].hacocms.com/api/v1/[endpoint]/[content_id]
$res = $client->listSingleContent('endpoint', 'content_id');
```

### Call single api.

* シングル形式APIのコール

```php
$client = new HacoCMS\V1\HacoCMSApiClient('subdomain', 'access_token');
// https://[subdomain].hacocms.com/api/v1/[endpoint]
$res = $client->single('endpoint');
```

## ライセンス

MIT License

