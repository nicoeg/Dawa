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
            'inCircle',
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
            'inCircle',
        ]
    ],
    'streets' => [
        'uri' => 'vejnavne',
        'singular' => 'street',
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
    'municipalities' => [
        'uri' => 'kommuner',
        'singular' => 'municipality',
        'methods' => [
            'general',
            'singular',
            'search',
            'byName',
            'inCircle',
        ]
    ],
    'regions' => [
        'uri' => 'regioner',
        'singular' => 'region',
        'methods' => [
            'general',
            'singular',
            'search',
            'byName',
        ]
    ],
    'provinces' => [
        'uri' => 'landsdele',
        'singular' => 'province',
        'methods' => [
            'general',
            'singular',
            'search',
            'byName',
        ]
    ],
];
