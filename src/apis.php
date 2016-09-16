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
    ],
    'accessAddresses' => [
        'uri' => 'adgangsadresser',
        'singular' => 'accessAddress',
        'methods' => [
            'general',
            'singular',
            'search',
            'byMunicipality',
            'byMunicipalities',
            'inCircle'
        ]
    ],
    'streetNames' => [
        'uri' => 'vejnavne',
        'singular' => 'streetName',
        'methods' => [
            'general',
            'signular',
            'search',
            'byName',
            'byMunicipality',
            'byMunicipalities',
        ]
    ]
];