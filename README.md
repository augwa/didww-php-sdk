# Usage

> Order Create

```php
$didwwClient = new \Augwa\Didww(
    $apiUsername,
    $apiPassword,
    $testMode // defaults to false
);
 
$result = $didwwClient->orderCreate(
    array(
        'customer_id' => 1,
        'country_iso' => 'CA',
        'period' => 1,
        'uniq_hash' => md5(time()),
    )
);

print_r($result);
```

> Output

```php
Array
(
    [result] => 0
    [country_name] => Canada
    [country_iso] => CA
    [city_name] => Toronto
    [city_prefix] => 647
    [city_id] => 276
    [did_number] => 16472584725
    [did_status] => 1
    [did_timeleft] => 2678400
    [did_expire_date_gmt] => 2017-04-11 22:18:30
    [order_id] => 1892977
    [order_status] => Completed
    [did_mapping_format] =>
    [did_setup] => 0.00
    [did_monthly] => 0.28
    [did_period] => 1
    [autorenew_enable] => 0
    [prepaid_balance] => 2.00
)
```

