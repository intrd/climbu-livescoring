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

Download SDcard image here: [backup.img.gz](https://drive.google.com/open?id=0B6VYbSIro9VTY1Z0MUI2eGFVeG8) (I recommend to use a 4gb Class 10 SD Card)

1. Just burn the image, boot up RPI3 and it will create a new wifi network called "ClimbU", default passwd: `climbu123654`
2. Connect and browse to `http://10.0.0.1` to access the ClimbU application, default login/pw: `intrd/meuovo123`
3. If you need to open a terminal on RPI3, SSH to 10.0.0.1 w/ `u: climbu, pw: 11`

## Windows
* [Portables](https://github.com/intrd/climbu-livescoring/releases) - latest version of climbu-livescoring portable 

![running_win](/shots/running_win.jpg?raw=true "running_win")

I've packed a portable version of climbu-lvescoring, easy-to-install, just follow this steps below..

1. Install `vc_redist.x86.exe` located at `climbu/climbu-livescoring/winlibs/vc_redist.x86.exe` or download here [Visual C++ Redistributable for Visual Studio 2015](http://www.microsoft.com/en-us/download/details.aspx?id=48145)
2. Download [latest portable version](https://github.com/intrd/climbu-livescoring/releases) of climbu-livescoring, unzip at `c:\climbu\`
3. Double click at `win_runwww.bat` to run and browse to your local ip, `http://localhost/` or network ip, something like `http://192.168.0.100/`, default login/pw: `juiz1/asd123asd`

# Administration

Not yet created an user-friendly admin interface, you will have to setup directly from the database.

* To setup your users, and details of competition like categories, sectors and athletes, browse to http://localhost:81, then point Adminer to `../DATA/climbu-livescoring.dat`. 

***Note***: On Windows setup, you need double click at `win_admindb.bat` to launch Adminer first, then browse to `http://localhost:91/`.

![sqliteadmin](/shots/sqliteadmin.jpg?raw=true "sqliteadmin")

# Screenshots & features
## Score display
Rotating score, you can easily adjust font size to fit at your monitor using ctrl+mouse roll
![display_score](/shots/display_i.png?raw=true "display_score")

Score by team..
![display_score](/shots/display_g.jpg?raw=true "display_score")

## Event log, detailed, you can easily copyn'paste on a spreadsheet.
![sectors](/shots/display_at.jpg?raw=true "sectors")

## Sectors & points
![sectors](/shots/sectors.jpg?raw=true "sectors")

## Mobile responsive layout
Lightweight user interface, works on any smartphone/tablet
![smart](/shots/smart.jpg?raw=true "smart")

## Tops 
Listing all tops registered by logged referee
![sectors](/shots/tops.jpg?raw=true "tops")

## Categories
Customizable categories, adaptable to your own competition format
![register_categs](/shots/register_catgs.jpg?raw=true "register_catgs")

# Climbu Livescoring IRL 
## CTF Bouldering marathon 2016 (by teams) (Vinhedo, São Paulo/Brazil)
Testing day..
![ctf001](/shots/ctfm001.jpg?raw=true "ctf001")

Climbing, markings on the wall, sectors and boulders by color, athletes by number..
![ctf002](/shots/ctfm002.jpg?raw=true "ctf002")

Self-organized climbing queue..
![ctf003](/shots/ctfm003.jpg?raw=true "ctf003")

ClimbU Running on a single RaspberryPi 3 (acting as router/server/display)
![ctf004](/shots/ctfm004.jpg?raw=true "ctf004")

Climbing ppl, another sector..
![ctf005](/shots/ctfm005.jpg?raw=true "ctf005")

More climbing..
![ctf006](/shots/ctfm006.jpg?raw=true "ctf006")

Self-organized climbing queue using physical tags on the wall..
![ctf007](/shots/ctfm007.jpg?raw=true "ctf007")

Referee w/ smartphone..
![ctf008](/shots/ctfm008.jpg?raw=true "ctf008")

Ending..
![ctf009](/shots/ctfm009.jpg?raw=true "ctf009")

Final results (teams and single)..
![ctf010](/shots/ctfm010.jpg?raw=true "ctf010")

* Full event log (attempts + tops) on a spreadsheet: http://bit.ly/2bgh7Zs

## Serra Master 2016 (Espirito Santo/Brazil) managed by ACE and Celina Takemura
Referee w/ smartphone..
![ctf001](/shots/serra1.jpg?raw=true "ctf001")

Climbing, markings on the wall, sectors and boulders by color, athletes by number..
![ctf002](/shots/serra2.jpg?raw=true "ctf002")

Climbing ppl..
![ctf003](/shots/serra3.jpg?raw=true "ctf003")

ClimbU running on a Windows machine..
![ctf004](/shots/serra4.jpg?raw=true "ctf004")


## UNICAMP Campeonato Capira 2016 (Campinas, São Paulo/Brazil)
![crowd1](/shots/climbin1.jpg?raw=true "climbing people")

ClimbU Running on a single RaspberryPi 3 (acting as router/server/display)
![raspberrypi](/shots/rpiscore.jpg?raw=true "raspberrypi score")

RaspberryPi 3 test before comp
![raspberrypi](/shots/rpi3test.jpg?raw=true "raspberrypi score")

Climbing people
![climbing](/shots/clim.jpg?raw=true "climbing people")

Climbing people (Climbu @ background)
![climbing](/shots/clim2.jpg?raw=true "climbing people")

## CTF Bouldering marathon 2016 (Vinhedo, São Paulo/Brazil)
![ct](/shots/ct.jpg?raw=true "ct")

Working display
![ct](/shots/end2.jpg?raw=true "ct")

Podium
![ct](/shots/end.jpg?raw=true "end")

![rankreal](/shots/rankreal.jpg?raw=true "rankreal")

Final score

# Setup a advanced development environment (Linux or Windows w/ Composer)

System requiriments & dependencies
```
$ sudo apt-get update & apt-get upgrade
$ sudo apt-get install curl php-curl php-cli php-mcrypt php-sqlite3 php-fpm git nginx
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

Now download the package (Composer automatically install all dependencies)
$ git clone https://github.com/intrd/climbu-livescoring && cd climbu-livescoring

$ composer install -o #to install
$ composer update -o #to update
$ mkdir climbu-livescoring/LOG
$ touch climbu-livescoring/LOG/viewlog.html
$ chown -R climbu:www-data climbu-livescoring/
$ chmod -R 774 climbu-livescoring/

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