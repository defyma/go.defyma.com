URL Shortener Application
================================

# go.defyma.com

INSTALLATION
------------

1. Clone
2. Update/Install Composer
3. Import `sql_dump/db.sql` to MySQL DBMS
4. Run on your Apache Server

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=shorturl',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

### Domain

Edit the file `config/param.php` with real data, for example:

```php
return [
    'adminEmail' => 'admin@example.com',
    'domain' => '<change_to_your_domain.com>'
];

```

**Thanks:**
- https://github.com/samdark/yii2-minimal
- https://github.com/briancray/PHP-URL-Shortener
