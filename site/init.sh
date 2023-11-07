sleep 10

certbot --apache -n --agree-tos --email loanpena77@gmail.com -d foliomaker.fr

/usr/sbin/apache2ctl -D FOREGROUND
