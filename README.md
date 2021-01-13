## Sign a request

```php
$key = 'testkey123';
$data = ['field1' => 'value1'];

$signer = new DBD\SignedRequest\Signer($key);
// or...
// $signer = DBD\SignedRequest\Signer::init($key);

$signedData = $signer->sign($data);
// or..
// $signedData = DBD\SignedRequest\Signer::init($key)->sign($data);

print_r($signedData);
// Array
// (
//     [field1] => value1
//     [hashed_data] => {"field1":"value1"}
//     [hash] => ab8c056075e89bb8e1fed1ed0dec7436
// )
```

## Validate a request

```php
$key = 'testkey123';
$signedData = [
    'field1' => 'value1',
    'hashed_data' => '{"field1":"value1"}',
    'hash' => 'ab8c056075e89bb8e1fed1ed0dec7436',
];

$signer = new DBD\SignedRequest\Signer($key);
// or...
// $signer = DBD\SignedRequest\Signer::init($key);

$isValid = $signer->validate($signedData);
// or...
// $isValid = DBD\SignedRequest\Signer::init($key)->validate($signedData);

print $isValid;
// true
```
