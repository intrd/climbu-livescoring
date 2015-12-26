```
/**
 * ClimbU - Dynamic and open source live scoring for competitions
 * 
* @package climbu-livescoring
* @version 2.0
* @link https://github.com/intrd/climbu-livescoring/
* @category system
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* @license Creative Commons Attribution-ShareAlike 4.0 International License - http://creativecommons.org/licenses/by-sa/4.0/
* Dependencies: 
* 	https://github.com/intrd/php-adminer/
* 	https://github.com/intrd/php-common/
* 	https://github.com/intrd/sqlite-dbintrd/
* 	https://github.com/intrd/php-mcrypt256CBC/
*/
```
## Downloads

* [Portables](https://github.com/intrd/climbu-livescoring/releases) - lastest version of climbu-livescoring portable 

![running_win](/shots/running_win.png?raw=true "running_win")

I've packed a portable version of climbu-lvescoring, easy-to-install, just follow this 5 steps below..

1. Download and install [Visual C++ Redistributable for Visual Studio 2015](http://www.microsoft.com/en-us/download/details.aspx?id=48145)
2. Download [lastest portable version](https://github.com/intrd/climbu-livescoring/releases) of climbu-livescoring, unzip at `c:\climbu\`
3. Edit `climbu/climbu-livescoring/config.php` and change `$homehost="192.168.0.100";` to your `LAN IP ADDRESS` (to test on 1st run, change only this variable)
4. Double click at `windows_run.bat` to run and access browsing to `http://192.168.0.100/` 
5. To admin, double click at `windows_admin_db.bat` to run and access browsing to `http://192.168.0.100:91/`, than point adminer to `../data/climbu-livescoring.dat`

## Screenshots
![display_score](/shots/display_score.png?raw=true "display_score")
![about](/shots/about.png?raw=true "about")
![register_already](/shots/register_already.png?raw=true "register_already")
![register_categs](/shots/register_catgs.png?raw=true "register_catgs")
![sectors](/shots/sectors.png?raw=true "sectors")
![sqliteadmin](/shots/sqliteadmin.png?raw=true "sqliteadmin")
![mobile](/shots/mobile.jpg?raw=true "mobile")
![running](/shots/running.png?raw=true "running")


## Development system installation
```
apt-get update & apt-get upgrade
apt-get install php5-curl php5-sqlite php5-cli php5-mcrypt

apt-get install git
git clone https://github.com/intrd/climbu-livescoring/
git clone https://github.com/intrd/php-adminer/
git clone https://github.com/intrd/php-common/
git clone https://github.com/intrd/sqlite-dbintrd/
git clone https://github.com/intrd/php-mcrypt256CBC/

```
### Windows environments

Download and install [Visual C++ Redistributable for Visual Studio 2015](http://www.microsoft.com/en-us/download/details.aspx?id=48145)

.. and uncomment extensions on php.ini:
```
extension=php\ext\php_curl.dll
extension=php\ext\php_gettext.dll
extension=php\ext\php_sqlite3.dll
```

## Directory structure
```
|_climbu-livescoring
|_run.sh //shortcut to run climbu at localhost:80
|_admin_db.sh //shortcut to run adminer at localhost:91 to manage sqlite3 database (just point ../data/climbu-livescoring.dat)
|_config.php //config file, take a look and change what u need..
 |_data
  |_climbu-livescoring.dat //sqlite3 climbu database
 |_langs
  |_pt_BR //to translate.. clone this directory to your language code open .po file w/ poedit and set per-user language at database or change main language at config.php
   |_LC_MESSAGES
    |_default.po //poedit language file
    |_default.mo 
 |_www //core web interface

```

# Running on Linux
```
./run.sh
..and access http://localhost/ to open web interface (default logon: intrd/meuovo123! )

./admin_db.sh & 
..shortcut to run adminer at localhost:91 to manage sqlite3 database (just point ../data/climbu-livescoring.dat)

```

# Running on Windows
```
Download lastest PHP non-threaded version and create BATs w/ something like: 
php\php.exe -c "php\php.ini" -S 0.0.0.0:80 -t climbu-livescoring/www //to run php built-in webserver and open climbu web interface
php\php.exe -c "php\php.ini" -S 0.0.0.0:91 -t climbu-livescoring/data //to run php built-in webserver and open adminer

..if u have any doubt, just download my windows_x86 [lastest portable](https://github.com/intrd/climbu-livescoring/releases) version and take a look at my BATs.
```



