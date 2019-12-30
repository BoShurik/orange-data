# [OrangeData][1] API Client

[![Build Status](https://travis-ci.com/BoShurik/orange-data.svg?branch=master)][2]

## API Version

2.25.0

## Usage

```php
$client = (new ClientBuilder(
    PRIVATE_KEY,
    PRIVATE_KEY_PASSWORD,
    CERT,
    CERT_PASSWORD,
    SSL_KEY,
    SSL_KEY_PASSWORD,
    VERIFY,
    ENDPOINT
))->build();

$document = new Document(uniqid(), INN, new Content(/*...*/));

$client->document($document);
```

## Examples

See [examples][3] dir

[1]: https://orangedata.ru/
[2]: https://travis-ci.com/BoShurik/orange-data
[3]: https://github.com/BoShurik/orange-data/tree/master/examples