#!/bin/bash
a2enmod ssl
a2ensite default-ssl
echo "#############################################################"
echo "## Switching to AllowOverride All for /var/www/html/code/* ##"
echo "#############################################################"
cd /etc/apache2
mkdir ssl
cd ssl
openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 -subj \
    "/C=AT/ST=UpperAustria/L=Hagenberg/O=FHOOE/CN=MH" \
    -keyout ./ssl.key -out ./ssl.crt
cd ../sites-enabled
+
sed -i '131i <Directory /var/www/html/code/*>' default-ssl.conf
sed -i '132i        Options Indexes FollowSymLinks MultiViews' default-ssl.conf
sed -i '133i        AllowOverride All' default-ssl.conf
sed -i '134i </Directory>' default-ssl.conf
sed -i 's+/etc/ssl/certs/ssl-cert-snakeoil.pem+/etc/apache2/ssl/ssl.crt+g' default-ssl.conf
sed -i 's+/etc/ssl/private/ssl-cert-snakeoil.key+/etc/apache2/ssl/ssl.key+g' default-ssl.conf
service apache2 restart
netstat -apnt |grep apache2
