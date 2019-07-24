Employees Bonuses and Deductions
=========

[![Build Status](https://travis-ci.org/miholeus/bonuses.svg?branch=master)](https://travis-ci.org/miholeus/bonuses)

Installation
===
Run docker
* `docker-compose up -d`

Go to container `docker-compose exec php bash` and run commands:
* Install deps
`make install` 
* Calculate salary for employee with kids
`php app.php bob --salary 5000 --age 36 --currency usd --kids=2 --car 0`
* Calculate salary for employee with car
`php app.php andy --salary 6000 --age 22 --car 1`

You can test your own variations

Testing
===
Go to container
`docker-compose exec php-unit bash` and run command:

* Test app
`make test`
