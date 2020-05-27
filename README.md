# amos-discussioni

Extension for create discussions.

## Installation

### 1. Add module to your application

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require open20/amos-discussioni
```

or add this row

```
"open20/amos-discussioni": "*"
```

to the require section of your `composer.json` file.

### 2. Add module configuration

Add module to your main config in backend like this:
	
```php
<?php
'modules' => [
    'discussioni' => [
        'class' => 'open20\amos\discussioni\AmosDiscussioni'
    ],
],
```

### 3. Apply migrations

To apply migrations you can launch this command:

```bash
php yii migrate/up --migrationPath=@vendor/open20/amos-discussioni/src/migrations
```

or add this row to your migrations config in console:

```php
<?php
return [
    '@vendor/open20/amos-discussioni/src/migrations',
];
```

### 4. Configure the required plugin amos-comments

After the configuration of amos-discussioni plugin you must configure amos-comments.
To see how to configure that plugin go to http://git.open20.it/amos/amos-comments/blob/master/README.md,
then add this configuration to modelsEnabled in amos-comments configuration:

```php
<?php
'modules' => [
    'comments' => [
        'class' => 'open20\amos\comments\AmosComments',
        'modelsEnabled' => [
            'open20\amos\discussioni\models\DiscussioniTopic'
        ]
    ],
],
```