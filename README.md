<!-- docbloc -->
<span id='docbloc'>
The ClimbU Livescoring is a multiplatform application that allows anyone to manage/display real-time scores. Originally developed for climbing competition(marathon) but can be easily adapted to other sports, other formats.
<table>
<tr>
<th>Package</th>
<td>intrd/climbu-livescoring</td>
</tr>
<tr>
<th>Version</th>
<td>3.0</td>
</tr>
<tr>
<th>Tags</th>
<td>competition, score, display, php, climbing, ranking</td>
</tr>
<tr>
<th>Project URL</th>
<td>http://github.com/intrd/climbu-livescoring</td>
</tr>
<tr>
<th>Author</th>
<td>intrd (Danilo Salles) - http://dann.com.br</td>
<tr>
<th>Copyright</th>
<td>(CC-BY-SA-4.0) 2016, intrd</td>
</tr>
<tr>
<th>License</th>
<td><a href='http://creativecommons.org/licenses/by-sa/4.0'>Creative Commons Attribution-ShareAlike 4.0</a></td>
</tr>
<tr>
<th>Dependencies</th>
<td> &#8226; php >=5.3.0 &#8226; intrd/php-common >=1.0.x-dev &#8226; intrd/sqlite-dbintrd >=1.0.x-dev &#8226; intrd/php-mcrypt256CBC >=1.0.x-dev </td>
</tr>
</table>
</span>
<!-- @docbloc 1.1 -->

# Intro

Extremely lightweight and designed to run over Raspberry Pi 3. 

- The RPI3 image is pre-configured to act as ClimbU server, WiFi AP Hotspot and HDMI display output
- The clients(judges) uses his own smartphones to access ClimbU browsing to local Web Application.

If you don't have an RPI3, don't worry, it works too on any desktop PC following this environment below:

- A working WiFi network
- A common PC (windows or linux)
- TV/Monitor w/ HDMI
- One or more smartphones (any specs) for the clients.

# Downloads (pre-configured)

## Raspberry Pi 3 Image

Download SDcard image here: (I recommend to use a Class 10 SD Card)

1. Just burn the image, boot up RPI3 and it will create a new wifi network called "ClimbU", default passwd: `climbu123654`
2. Connect and browse to `http://10.10.0.1` to access the application, default login/pw: `intrd/meuovo123`

## Windows
* [Portables](https://github.com/intrd/climbu-livescoring/releases) - latest version of climbu-livescoring portable 

![running_win](/shots/running_win.jpg?raw=true "running_win")

I've packed a portable version of climbu-lvescoring, easy-to-install, just follow this 5 steps below..

1. Install `vc_redist.x86.exe` located at `climbu/climbu-livescoring/winlibs/vc_redist.x86.exe` or download here [Visual C++ Redistributable for Visual Studio 2015](http://www.microsoft.com/en-us/download/details.aspx?id=48145)
2. Download [latest portable version](https://github.com/intrd/climbu-livescoring/releases) of climbu-livescoring, unzip at `c:\climbu\`
3. Edit `climbu/climbu-livescoring/config.php` and change `$homehost="192.168.0.100";` to your `LAN IP ADDRESS` (to test on 1st run, change only this variable)
4. Double click at `windows_run.bat` to run and access browsing to `http://192.168.0.100/`, default login/pw: `intrd/meuovo123`
5. To admin, double click at `windows_admin_db.bat` to run and access browsing to `http://192.168.0.100:91/`, than point adminer to `../data/climbu-livescoring.dat`

# Administration

To setup your users, and details of competition like categories, sectors and athletes, browse to http://10.10.0.1:81, then point Adminer to `../data/climbu-livescoring.dat`. Not yet created an user-friendly admin interface, you will have to setup directly from the database.

![sqliteadmin](/shots/sqliteadmin.jpg?raw=true "sqliteadmin")

# Screenshots & features
## Score display
Rotating score, you can easily adjust font size to fit at your monitor using ctrl+mouse roll
![display_score](/shots/display_score.jpg?raw=true "display_score")

## Sectors & points
![sectors](/shots/sectors.jpg?raw=true "sectors")

## Mobile responsive layout
Lightweight user interface, works on any smartphone/tablet
![smart](/shots/smart.jpg?raw=true "smart")

## Tops 
List all tops registered by logged referee
![sectors](/shots/tops.jpg?raw=true "tops")

## Categories
Customizable categories to adapt to your own competition format
![register_categs](/shots/register_catgs.jpg?raw=true "register_catgs")

# Climbu Livescoring IRL 
CTF Bouldering marathon 2016 (Vinhedo, São Paulo/Brazil)
![ct](/shots/ct.jpg?raw=true "ct")

Working display
![ct](/shots/end2.jpg?raw=true "ct")

Podium
![ct](/shots/end.jpg?raw=true "end")

![rankreal](/shots/rankreal.jpg?raw=true "rankreal")

Final score

# Setup a advanced development environment (Linux)

System requiriments & dependencies
```
$ sudo apt-get update & apt-get upgrade
$ sudo apt-get install php-curl php-cli php-mcrypt php-sqlite3 php-fpm git nginx
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

Now download the package (Composer automatically install all dependencies)
$ git clone https://github.com/intrd/telegram-livescoring && cd telegram-livescoring

$ composer install -o #to install
$ composer update -o #to update

$ ./runwww.sh #to run climbu locally, acess by browsing http://localhost (its a single thread webserver for development only)
$ ./admindb.sh #to launch Adminer on http://localhost:8000
```
# Translation/Locale problems?

Uncomment a line containing `pt_BR.UTF-8` on `/etc/locale.gen` and then.. 
```
$ sudo locale-gen
```

# Whitelisted ips to use admindb.sh
The whitelist is disabled by default, if you want to enable it to secure Adminer access check `dba/index.php`

# Translations

The default language is `en_US`, but you can translate to any language you want, just follow my `pt_BR` translation file sample.

![pedit](/shots/poedit.jpg?raw=true "poedit")

1. At `langs` directory, clone `pt_BR` to a new directory w/ your language code 
2. Open `default.po` w/ poedit (https://poedit.net/download) and start translating
3. Open `www/config.php` file and change `$language = "en_US.UTF-8";` to your language.
4. Or, if you want multilanguage users, open `database/users` and set the individual user language. 


```
If you fork it, please link-me and respect the license.
```