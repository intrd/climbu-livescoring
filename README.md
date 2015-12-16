```
/**
 * ClimbU - Dynamic and open source live scoring for competitions
 * 
* @package climbu-livescoring
* @version 2.0
* @category system
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* license: Creative Commons Attribution-ShareAlike 4.0 International License - http://creativecommons.org/licenses/by-sa/4.0/
* @link https://github.com/intrd/climbu-livescoring/
* Dependencies: 
* 	https://github.com/intrd/php-adminer/
* 	https://github.com/intrd/php-common/
* 	https://github.com/intrd/sqlite-dbintrd/
* 	https://github.com/intrd/php-mcrypt256CBC/
*/
```

## System installation
```
apt-get update & apt-get upgrade
apt-get install php5-curl php5-sqlite php5-cli

apt-get install git
git clone https://bitbucket.org/intrd/climbu-livescoring/
```
**Attention**: stay outside main project path and install dependencies/directory structure..

## Dependencies installation
```
git clone [all git dependencies listed at header]
ex: git clone https://github.com/intrd/php-common/
```

## Directory structure
Create these directories & files:

* ../DATA/climbu-livescoring.dat (sqlite3 table)
* ../LOGS 
* ../TMP 

# Running
```
screen //to attach current screen
./run.sh 

.. and access http://localhost/ to open web interface (default logon: intrd/meuovo123! )

./admin_db.sh & //to open webserver for database adminitration

```
```