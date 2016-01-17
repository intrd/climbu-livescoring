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
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0/
* Dependencies: Yes, details at README.md
*/
```
## Downloads

* [Portables](https://github.com/intrd/climbu-livescoring/releases) - lastest version of climbu-livescoring portable 

![running_win](/shots/running_win.jpg?raw=true "running_win")

I've packed a portable version of climbu-lvescoring, easy-to-install, just follow this 5 steps below..

1. Install `vc_redist.x86.exe` located at `climbu/climbu-livescoring/winlibs/vc_redist.x86.exe` or download here [Visual C++ Redistributable for Visual Studio 2015](http://www.microsoft.com/en-us/download/details.aspx?id=48145)
2. Download [lastest portable version](https://github.com/intrd/climbu-livescoring/releases) of climbu-livescoring, unzip at `c:\climbu\`
3. Edit `climbu/climbu-livescoring/config.php` and change `$homehost="192.168.0.100";` to your `LAN IP ADDRESS` (to test on 1st run, change only this variable)
4. Double click at `windows_run.bat` to run and access browsing to `http://192.168.0.100/`, default login/pw: `intrd/meuovo123!`
5. To admin, double click at `windows_admin_db.bat` to run and access browsing to `http://192.168.0.100:91/`, than point adminer to `../data/climbu-livescoring.dat`

## Screenshots
### Score display
Rotating score, you can easily adjust font size to fit at your monitor using ctrl+mouse roll
![display_score](/shots/rankreal.jpg?raw=true "display_score")

### Sectors & points
![sectors](/shots/sectors.jpg?raw=true "sectors")

### Mobile responsive layout
Lightweight user interface, works on any smartphone/tablet
![smart](/shots/smart.jpg?raw=true "smart")

### Tops 
List all tops registered by logged referee
![sectors](/shots/tops.jpg?raw=true "tops")

### Categories
Customizable categories to adapt to your own championship format
![register_categs](/shots/register_catgs.jpg?raw=true "register_catgs")

### Database admin
SQLite admin to raw database access 
![sqliteadmin](/shots/sqliteadmin.jpg?raw=true "sqliteadmin")

## Setup a development environment (Linux)
```
apt-get update & apt-get upgrade
apt-get install php5-curl php5-sqlite php5-cli php5-mcrypt

apt-get install git
git clone https://github.com/intrd/climbu-livescoring/

# Dependencies.. 
Stay outside and clone all dependencies below..
git clone https://github.com/intrd/php-adminer/
git clone https://github.com/intrd/php-common/
git clone https://github.com/intrd/sqlite-dbintrd/
git clone https://github.com/intrd/php-mcrypt256CBC/

# Locale setup 
Uncomment a line containing pt_BR.UTF-8 on /etc/locale.gen and then run: sudo locale-gen

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
Follow this sample structure..
```
|_climbu-livescoring
|_run.sh //shortcut to run climbu at localhost:80
|_admin_db.sh //shortcut to run adminer at localhost:91 to manage sqlite3 database (database path ../data/climbu-livescoring.dat)
|_config.php //config file, take a look and change what u need..
 |_data
  |_climbu-livescoring.dat //sqlite3 climbu database
 |_langs
  |_pt_BR //clone this directory for translatins, more details below
   |_LC_MESSAGES
    |_default.po //poedit language file
    |_default.mo 
 |_www //user web interface
|_php-adminer //dependency
|_php-common //dependency
|_sqlite-dbintrd //dependency
|_php-mcrypt256CBC //dependency


```

# Translations

The default language is en_US, but you can translat to any language u want, just follow my pt_BR translation file sample.

![pedit](/shots/poedit.jpg?raw=true "poedit")

1. At `langs` directory, clone `pt_BR` to a new directory w/ your language code 
2. Open `default.po` w/ poedit (https://poedit.net/download) and start translating
3. Open `www/config.php` file and change `$language = "en_US.UTF-8";` to your language.
4. If you want multilanguage users, open `database/users` and set the individual user language. 


# Running
![running](/shots/running.jpg?raw=true "running")
```
./run.sh
..and access http://localhost/ to open web interface (default login: intrd/meuovo123!)

./admin_db.sh & 
..shortcut to run adminer at localhost:91 to manage sqlite3 database (just point ../data/climbu-livescoring.dat)

Windows machine? 
just download my windows_x86 portable: https://github.com/intrd/climbu-livescoring/releases
```

### Climbu Livescoring IRL 
CTF Bouldering marathon 2016 (Vinhedo, São Paulo/Brazil)

Full score
![rankreal](/shots/rankreal.jpg?raw=true "rankreal")

Display and crowd..
![ct](/shots/ct.jpg?raw=true "ct")

Podium
![ct](/shots/end.jpg?raw=true "end")