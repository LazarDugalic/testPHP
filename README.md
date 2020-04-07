# Test (PHP 7)

### System requirements
    -  Linux OS
    -  PHP (7.1 or higher)
    -  Web Server (Recommended: Apache. Use of php's built in development server is also possible)
    -  Database server (MySQL 5.5+ or MariaDB 10.0+)
    -  Composer
    -  Git (fore development)

### Clone repository
    - $ cd
    - $ git clone https://github.com/LazarDugalic/testPHP.git
    - $ sudo mv test/ /var/www/core.local
    - $ cd /var/www/core.local
    -    
### Import database
    Go to mysql console and type :
    - create database test character set utf8;
    - $ mysql -u root test < sql/test.sql  
    
### Install packages
    - $ composer install
    - $ npm install
    
### Apache configuration   
    - $ sudo cp apache2/core.conf /etc/apache2/sites-enabled/core.conf
    - $ sudo service apache2 restart
    - $ echo '127.0.0.1 core.local' | sudo tee --append /etc/hosts >/dev/null

### Dump autoload
    - $ composer dump-autoload -o        

