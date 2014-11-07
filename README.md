# Collection

[![Latest Version](https://img.shields.io/github/release/funivan/collection.svg?style=flat-square)](https://github.com/funivan/collection/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/funivan/collection/master.svg?style=flat-square)](https://travis-ci.org/funivan/collection)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/funivan/collection.svg?style=flat-square)](https://scrutinizer-ci.com/g/funivan/collection/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/funivan/collection.svg?style=flat-square)](https://scrutinizer-ci.com/g/funivan/collection)
[![Total Downloads](https://img.shields.io/packagist/dt/funivan/collection.svg?style=flat-square)](https://packagist.org/packages/funivan/collection)

Manipulate array of items in OOP style.
`ObjectCollection` - contain/manipulate objects only with specific class
`TypedCollection`  - contain/manipulate items with defined validation rule 
`BaseCollection`  - contain/manipulate any items 

`ObjectCollection` it the most useful collection. 
You can specify class of object and add only this objects. All validations perform `ObjectCollection` Other data types restricted.
This class guarantee strict type data.
 

## Install

Via Composer

``` bash
$ composer require fiv/collection
```


## Base collection usage


``` php
$collection = new \Fiv\Collection\BaseCollection();
$collection[] = 1;
$collection[] = 2;
echo $skeleton->getFirst()
```


## Example : ObjectCollection 
In java there ara features like `ArrayList<UserModel>` in php you can extend `ObjectCollection` to `UserModelCollection` and define class name.

```php
class UserModel {
  public function getName(){
  
  }
}

class UsersCollection extend  ObjectCollection {
  public function objectsClassName(){
    return 'UserModel';
  }
}

# .... 
$users = new UserCollection();

foreach($users as $user){
  # at this point you can drop out all you validations
  # ObjectCollection guarantee that all items are UserModel
  $user->getName(); 
}


$users->append(123); // Fail. 123 is not instance of UserModel  

```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/funivan/collection/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Ivan Scherbak](https://github.com/funivan)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
