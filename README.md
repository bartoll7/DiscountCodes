# Requirements #
* composer
* php 7.0.23
* symfony 3.1



# Installation #

```bash
$ composer install

```
Set directory where generated codes will be stored using this key:
```bash
generated_codes_directory:

```
Default location is set to:
```bash
/web

```

# Run #
```bash
$ php bin/console server:run
```
Browser:
```
http://127.0.0.1:8000/codes
```

# Console #
```bash

$ php bin/console codes:generate <length> <count>
Arguments:
  quantity                   Quantity of codes
  length                     Length of  code
Options:
  --save                     If defined, codes will be saved into the file
```