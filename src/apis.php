<?php

return [
    'zipcodes' => [
        'uri' => 'postnumre',
        'singular' => 'zipcode',
        'methods' => [
            'general',
            'singular',
            'search',
            'byName',
            'byMunicipality',
            'byMunicipalities',
            'inCircle',
        ]
    ],
    'addresses' => [
        'uri' => 'adresser',
        'singular' => 'address',
        'methods' => [
            'general',
            'singular',
            'search',
            'byMunicipality',
            'byMunicipalities',
            'inCircle'
        ]
    ]
];