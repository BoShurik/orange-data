<?php
/**
 * User: boshurik
 * Date: 30.12.19
 * Time: 14:41
 */

define('PRIVATE_KEY', __DIR__ . '/../var/private_key_test.pem');
define('PRIVATE_KEY_PASSWORD', null);
define('CERT', __DIR__ . '/../var/client.crt'); // client.pfx for Mac OS X
define('CERT_PASSWORD', '1234');
define('SSL_KEY', __DIR__ . '/../var/client.key');
define('SSL_KEY_PASSWORD',  '1234');
define('VERIFY', __DIR__ . '/../var/cacert.pem');
define('ENDPOINT', 'https://apip.orangedata.ru:2443/api/v2/');
define('INN', '1234567890');