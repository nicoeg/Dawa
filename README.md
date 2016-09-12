# Dawa PHP Wrapper
PHP Wrapper til [Danmarks Adressers Web API](http://dawa.aws.dk).

##Installering
`composer require nicoeg/dawa`

Inkluder composers autoload hvor Dawa skal bruges eller i en bootstrap fil.

 `require 'vendor/autoload.php';`

##Brug
`$dawa = new Dawa;`

`$dawa->zipcode("5200");`

Se alle metoder under [Apis](ttps://github.com/nicoeg/Dawa/tree/master/src/Apis).

###Laravel
Ved brug med Laravel skal ServiceProvideren tilføjes til `$providers` arrayet i `config/app.php`.

`Nicoeg\Dawa\DawaServiceProvider::class`

Hvis du vil bruge facaden skal den tilføjes til `$facades` arrayet længere nede.

`'Dawa' => Nicoeg\Dawa\DawaFacade::class`
 
 Herefter kan alle Dawa klassens metoder kaldes således.
 
`Dawa::zipcodeSearch("Odense");`
 
####Stadig under udvikling, og mangler derfor stadig mange metoder.