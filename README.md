# SMNBOTS in der NXTbots Version

Achtung
Mod_Rewrite muss aktiviert werden
```
a2enmod rewrite

service apache2 restart

nano /etc/apache2/sites-available/000-default.conf

<Directory “/var/www/html”>
AllowOverride All
</Directory>

service apache2 restart
```
