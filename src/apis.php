<?php

return [
    'zipcodes' => [
        'uri' => 'postnumre',
        'singular' => 'zipcode',
        'methods' => [
            'general',
            'singular',
            'byName',
            'inCircle',
        ]
    ],
    'addresses' => [
        'uri' => 'adresser',
        'singular' => 'address',
        'methods' => [
            'general',
            'singular',
            'inCircle'
        ]
    ]
];