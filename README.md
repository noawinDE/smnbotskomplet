# SMNBOTS in der NXTbots Version

Hast du Angst über die Sicherheit deiner Daten bei öffentlichen Hostern? Nerven dich die ganzen Einschränkungen? Willst du Heer deiner eigenen Bot Armee sein? Also warum nicht einfach selber hosten!

> Das NXTBOTS Team hat sich dazu entschieden jedem die Möglichkeit zu geben, selber seine Bots zu hosten und das auf einem gewohnten Interface. Was du hier bekommst, ist keine geklaute oder billig nachprogrammierte Version von SMNkakbots und zwar eine leicht endbugte und verbesserte version von NXTBots. Hier bekommst du die originale Version des SMNBOTS V1 Interfaces in der Hosting variante.

# Instalation

- Instaliere den [`TS3 Audiobot`](https://github.com/Splamy/TS3AudioBot#install) von Splamy
- Lade alle Dateien aus dem `web` Ordner auf deinen Webserver hoch
- Importiere die SQL Datei in deine Datenbank
- Trage alle benötigten Werte in der Config ein `/vendor/smnbots/Config.php`
- registrieren und rechte geben fertig
```php
const  
  DB_HOST = "",  // Die Adresse deines Datenbankservers   
  DB_NAME = "",  // Der Name deiner Datenbank
  DB_USER = "",  // Benutzername deines Datenbank Nutzers
  DB_PSSWD = ""; // Passwort deines Datenbank Nutzers
  
  
const nodes = array(  
  1 => array(  
  'host' => '',   // Adresse deines TS3AudioBot Servers
  'port' => 1234, // Port deines TS3AudioBot Servers
  'key' => '',    // API Token (Dafür musst du den Bot mit !api token anschreiben)
  )
);
```

Achtung 
```
'key' => 'uid:token',    // API Token (bei der neuen ts3audio bot version)
'key' => 'uid:ts3ab:token',    // API Token (Aber es muss bei dem pannel so aus schauen)

```
# FAQ
- **Wie füge ich eine weitere Node hinzu?**
> Eine weitere Node fügst ohne große Kopfschmerzen ein. Gehe dazu einfach in die Config `/vendor/smnbots/Config.php` scrolle bis nach unten zum Bereich `const nodes = array(...)`. Dort stehen alle deine Nodes. Um nun eine weitere Node hinzuzufügen, machst du einfach nach dem letzten Eintrag ein ``,`` und fügst den unten stehenden Code ein (natürlich mit deinen Werten)
```

php
2 => array(       // Die 2 ist immer die Letzte nummer der Liste Plus 1 gerechntet (also nach dem EIntrag würde z.B. eine 3 kommen) 
  'host' => '',   // Adresse deines TS3AudioBot Servers
  'port' => 1234, // Port deines TS3AudioBot Servers
  'key' => '',    // API Token (Dafür musst du den Bot mit !api token anschreiben)
 
  )
```

Achtung
Mod_Rewrite muss aktiviert werden
```
a2enmod rewrite

service apache2 restart

nano /etc/apache2/sites-available/000-default.conf

<Directory /var/www/html>
AllowOverride All
</Directory>

service apache2 restart
```
