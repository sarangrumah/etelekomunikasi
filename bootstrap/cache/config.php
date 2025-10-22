<?php return array (
  'app' => 
  array (
    'name' => 'Sistem Elektronik Penyelenggaraan Telekomunikasi (e-Telekomunikasi)',
    'env' => 'PRODUCTION',
    'debug' => true,
    'url' => 'https://e-telekomunikasi.komdigi.go.id/',
    'asset_url' => NULL,
    'timezone' => 'Asia/Jakarta',
    'locale' => 'id',
    'fallback_locale' => 'en',
    'faker_locale' => 'id_ID',
    'key' => 'base64:6NcbvHU1dg/h19BS8JcypeVgRPpNXlq09RZckIg2FDg=',
    'cipher' => 'AES-256-CBC',
    'admin' => 
    array (
      'limit' => 10,
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Bepsvpt\\SecureHeaders\\SecureHeadersServiceProvider',
      23 => 'Webklex\\PDFMerger\\Providers\\PDFMergerServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\EventServiceProvider',
      27 => 'App\\Providers\\RouteServiceProvider',
      28 => 'Barryvdh\\DomPDF\\ServiceProvider',
      29 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      30 => 'Spatie\\Csp\\CspServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Riwayat' => 'Illuminate\\Support\\Facades\\Riwayat',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'PDF' => 'Barryvdh\\DomPDF\\Facades',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'QrCode' => 'SimpleSoftwareIO\\QrCode\\Facades\\QrCode',
      'PDFMerger' => 'Webklex\\PDFMerger\\Facades\\PDFMergerFacade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'password_reset',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/kominfo_v5/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'sistem_elektronik_penyelenggaraan_telekomunikasi_e_telekomunikasi_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'csp' => 
  array (
    'policy' => 'Spatie\\Csp\\Policies\\Basic',
    'report_only_policy' => '',
    'report_uri' => '',
    'enabled' => false,
    'nonce_generator' => 'Spatie\\Csp\\Nonce\\RandomString',
    'add_nonce_for' => 
    array (
      0 => 'script-src',
      1 => 'style-src',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'db_kominfo',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_kominfo',
        'username' => 'dbkominfo_admin',
        'password' => 'old_password',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_kominfo',
        'username' => 'dbkominfo_admin',
        'password' => 'old_password',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_kominfo',
        'username' => 'dbkominfo_admin',
        'password' => 'old_password',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'sistem_elektronik_penyelenggaraan_telekomunikasi_e_telekomunikasi_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'convert_entities' => true,
    'defines' => 
    array (
      'font_dir' => '/var/www/kominfo_v5/storage/fonts',
      'font_cache' => '/var/www/kominfo_v5/storage/fonts',
      'temp_dir' => '/tmp',
      'chroot' => '/var/www/kominfo_v5',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'bookman old style',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => '/var/www/kominfo_v5/storage/framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/kominfo_v5/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/kominfo_v5/storage/app/public',
        'url' => 'https://e-telekomunikasi.komdigi.go.id//storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
      ),
    ),
    'links' => 
    array (
      '/var/www/kominfo_v5/public/storage' => '/var/www/kominfo_v5/storage/app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => 'null',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/kominfo_v5/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/kominfo_v5/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Riwayat',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/var/www/kominfo_v5/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'smtp.kominfo.go.id',
        'port' => '587',
        'encryption' => 'TLS',
        'username' => 'e-telekomunikasi@kominfo.go.id',
        'password' => 'K0minfo#2024',
        'timeout' => NULL,
        'auth_mode' => NULL,
        'stream' => 
        array (
          'ssl' => 
          array (
            'allow_self_signed' => true,
            'verify_peer' => false,
            'verify_peer_name' => false,
          ),
        ),
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -t -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'e-telekomunikasi@kominfo.go.id',
      'name' => 'Sistem Elektronik Penyelenggaraan Telekomunikasi (e-Telekomunikasi)',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/kominfo_v5/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'recaptcha' => 
  array (
    'api_site_key' => '6LcWBlUiAAAAAFgUZUAVK2NC0YePztV7Cz7OHkkw',
    'api_secret_key' => '6LcWBlUiAAAAAAvckyQsUOaLzv50zZPVi9FpIoeK',
    'version' => 'v2',
    'curl_timeout' => 10,
    'skip_ip' => 
    array (
    ),
    'default_validation_route' => 'biscolab-recaptcha/validate',
    'default_token_parameter_name' => 'token',
    'default_language' => NULL,
    'default_form_id' => 'biscolab-recaptcha-invisible-form',
    'explicit' => false,
    'api_domain' => 'www.google.com',
    'empty_message' => false,
    'error_message_key' => 'validation.recaptcha',
    'tag_attributes' => 
    array (
      'theme' => 'light',
      'size' => 'normal',
      'tabindex' => 0,
      'callback' => NULL,
      'expired-callback' => NULL,
      'error-callback' => NULL,
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'e-telekomunikasi.komdigi.go.id',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'secure-headers' => 
  array (
    'server' => '',
    'x-content-type-options' => 'nosniff',
    'x-download-options' => 'noopen',
    'x-frame-options' => 'sameorigin',
    'x-permitted-cross-domain-policies' => 'none',
    'x-powered-by' => '',
    'x-xss-protection' => '1; mode=block',
    'referrer-policy' => 'no-referrer',
    'cross-origin-embedder-policy' => 'unsafe-none',
    'cross-origin-opener-policy' => 'unsafe-none',
    'cross-origin-resource-policy' => 'cross-origin',
    'clear-site-data' => 
    array (
      'enable' => false,
      'all' => false,
      'cache' => true,
      'cookies' => true,
      'storage' => true,
      'executionContexts' => true,
    ),
    'hsts' => 
    array (
      'enable' => true,
      'max-age' => 31536000,
      'include-sub-domains' => false,
      'preload' => false,
    ),
    'expect-ct' => 
    array (
      'enable' => true,
      'max-age' => 2147483648,
      'enforce' => false,
      'report-uri' => NULL,
    ),
    'permissions-policy' => 
    array (
      'enable' => true,
      'accelerometer' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'ambient-light-sensor' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'autoplay' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'battery' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'camera' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'cross-origin-isolated' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'display-capture' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'document-domain' => 
      array (
        'none' => false,
        '*' => true,
        'self' => false,
        'origins' => 
        array (
        ),
      ),
      'encrypted-media' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'execution-while-not-rendered' => 
      array (
        'none' => false,
        '*' => true,
        'self' => false,
        'origins' => 
        array (
        ),
      ),
      'execution-while-out-of-viewport' => 
      array (
        'none' => false,
        '*' => true,
        'self' => false,
        'origins' => 
        array (
        ),
      ),
      'fullscreen' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'geolocation' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'gyroscope' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'magnetometer' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'microphone' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'midi' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'navigation-override' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'payment' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'picture-in-picture' => 
      array (
        'none' => false,
        '*' => true,
        'self' => false,
        'origins' => 
        array (
        ),
      ),
      'publickey-credentials-get' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'screen-wake-lock' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'sync-xhr' => 
      array (
        'none' => false,
        '*' => true,
        'self' => false,
        'origins' => 
        array (
        ),
      ),
      'usb' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'web-share' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
      'xr-spatial-tracking' => 
      array (
        'none' => false,
        '*' => false,
        'self' => true,
        'origins' => 
        array (
        ),
      ),
    ),
    'csp' => 
    array (
      'enable' => true,
      'report-only' => false,
      'report-to' => '',
      'report-uri' => 
      array (
      ),
      'block-all-mixed-content' => false,
      'upgrade-insecure-requests' => false,
      'base-uri' => 
      array (
      ),
      'child-src' => 
      array (
      ),
      'connect-src' => 
      array (
      ),
      'default-src' => 
      array (
      ),
      'font-src' => 
      array (
      ),
      'form-action' => 
      array (
      ),
      'frame-ancestors' => 
      array (
      ),
      'frame-src' => 
      array (
      ),
      'img-src' => 
      array (
      ),
      'manifest-src' => 
      array (
      ),
      'media-src' => 
      array (
      ),
      'navigate-to' => 
      array (
        'unsafe-allow-redirects' => false,
      ),
      'object-src' => 
      array (
      ),
      'plugin-types' => 
      array (
      ),
      'prefetch-src' => 
      array (
      ),
      'require-trusted-types-for' => 
      array (
        'script' => false,
      ),
      'sandbox' => 
      array (
        'enable' => false,
        'allow-downloads-without-user-activation' => false,
        'allow-forms' => false,
        'allow-modals' => false,
        'allow-orientation-lock' => false,
        'allow-pointer-lock' => false,
        'allow-popups' => false,
        'allow-popups-to-escape-sandbox' => false,
        'allow-presentation' => false,
        'allow-same-origin' => false,
        'allow-scripts' => false,
        'allow-storage-access-by-user-activation' => false,
        'allow-top-navigation' => false,
        'allow-top-navigation-by-user-activation' => false,
      ),
      'script-src' => 
      array (
        'none' => false,
        'self' => false,
        'report-sample' => false,
        'allow' => 
        array (
        ),
        'schemes' => 
        array (
        ),
        'unsafe-inline' => false,
        'unsafe-eval' => false,
        'unsafe-hashes' => false,
        'strict-dynamic' => false,
        'hashes' => 
        array (
          'sha256' => 
          array (
          ),
          'sha384' => 
          array (
          ),
          'sha512' => 
          array (
          ),
        ),
      ),
      'script-src-attr' => 
      array (
      ),
      'script-src-elem' => 
      array (
      ),
      'style-src' => 
      array (
      ),
      'style-src-attr' => 
      array (
      ),
      'style-src-elem' => 
      array (
      ),
      'trusted-types' => 
      array (
        'enable' => false,
        'allow-duplicates' => false,
        'default' => false,
        'policies' => 
        array (
        ),
      ),
      'worker-src' => 
      array (
      ),
    ),
    'Access-Control-Allow-Methods' => 
    array (
      'GET' => true,
      'POST' => true,
      'PUT' => true,
      'PATCH' => true,
      'DELETE' => true,
      'OPTIONS' => true,
    ),
    'Access-Control-Allow-Headers' => 
    array (
      'Content-Type' => true,
      'Authorization' => true,
      'X-Requested-With' => true,
      'X-CSRF-Token' => true,
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/kominfo_v5/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'sistem_elektronik_penyelenggaraan_telekomunikasi_e_telekomunikasi_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/kominfo_v5/resources/views',
    ),
    'compiled' => '/var/www/kominfo_v5/storage/framework/views',
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'role_pivot_key' => NULL,
      'permission_pivot_key' => NULL,
      'model_morph_key' => 'model_id',
      'team_foreign_key' => 'team_id',
    ),
    'register_permission_check_method' => true,
    'teams' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      \DateInterval::__set_state(array(
         'from_string' => true,
         'date_string' => '24 hours',
      )),
      'key' => 'spatie.permission.cache',
      'store' => 'default',
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
