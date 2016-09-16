# Dawa API PHP Wrapper
PHP Wrapper til [Danmarks Adressers Web API](http://dawa.aws.dk).

##Installering - composer
`composer require nicoeg/dawa`

Inkluder composers autoload hvor Dawa skal bruges eller i en bootstrap fil.

 `require 'vendor/autoload.php';`

##Brug
`$dawa = new Nicoeg\Dawa\Dawa;`

`$dawa->zipcode("5200");`

For pagination

`$dawa->paginate(25, 1)->zipcodes(['q' => 'Odense']);`

Eller brug i constructor

`$dawa = new Dawa(25, 1);`

Se alle metoder under [Apis](https://github.com/nicoeg/Dawa/tree/master/src/Apis), eller længere nede.

###Laravel
Ved brug med Laravel skal ServiceProvideren tilføjes til `$providers` arrayet i `config/app.php`.

`Nicoeg\Dawa\DawaServiceProvider::class`

Hvis du vil bruge facaden skal den tilføjes til `$facades` arrayet længere nede.

`'Dawa' => Nicoeg\Dawa\DawaFacade::class`
 
Herefter kan alle Dawa klassens metoder kaldes således.
 
`Dawa::zipcodeSearch("Odense");`

###Metoder
| [Postnumre](http://dawa.aws.dk/postnummerdok)          | Parametre                                             | Return |
| -------------------------------------------------------|-------------------------------------------------------|--------|
| zipcodes($data)                                        | GET parametre                                         | array  |
| zipcode($zipcode, $data)                               | postnummer, GET parametre                             | object |
| zipcodeSearch($query, $data)                           | søgeord, GET parametre                                | array  |
| zipcodeByName($name, $data                             | navn, GET parametre                                   | object |
| zipcodesByMunicipalities($municipalities, $data)       | kommunekoder i array, GET parametre                   | array  |
| zipcodesByMunicipality($municipality, $data            | kommunekode, GET parametre                            | array  |
| zipcodesInCircle($latitude, $longitude, $radius, $data | breddegrad, længdegrad, radius i meter, GET parametre | array  |
| zipcodesInPolygon($polygon, $data)                     | Under udvikling                                       | array  |

---

| [Adresser](http://dawa.aws.dk/adressedok)                | Parametre                                             | Return |
| -------------------------------------------------------  |-------------------------------------------------------|--------|
| addresses($data)                                         | GET parametre                                         | array  |
| addressesInCircle($latitude, $longitude, $radius, $data) | breddegrad, længdegrad, radius i meter, GET parametre | array  |
 
####Stadig under udvikling, og mangler derfor stadig mange metoder.