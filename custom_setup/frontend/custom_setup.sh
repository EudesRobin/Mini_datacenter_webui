#!/usr/bin/env bash

set -e

echo "Git & curl setup"
apt-get -y install git-core php5-curl

echo " Clone webui"
cd /var/www
git clone https://github.com/EudesRobin/webui-oardocker.git

echo " custom apache config "

<Directory \"/var/www/webui-oardocker/custom_setup\">
        deny from all
</Directory>

<Directory \"/var/www/webui-oardocker/.git\">
        deny from all
</Directory>" >> /etc/apache2/apache2.conf
