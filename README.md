# Netease


Step1: 安装, `composer require "superman2014/filesystem-aliyun:1.0.x@dev"`

Step2: 注册 `Superman2014\Filesystem\Aliyun\AliyunServiceProvider` 到`config/app.php` 配置文件:

```
'providers' => [
    // Other service providers...

    Superman2014\Filesystem\Aliyun\AliyunServiceProvider::class,
],

```

Step3: 打开`config/filesystems.php`

配置文件内容如下:

```

    'cloud' => 'aliyun',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

        'aliyun' => [
            'driver'        => 'aliyun',
            // Your Aliyun OSS AccessKey
            'access_key'     => env('ALIYUN_OSS_ACCESS_KEY'),
            // Your Aliyun OSS AccessSecret
            'access_secret'    => env('ALIYUN_OSS_ACCESS_SECRET'),
            'bucket'        => env('ALIYUN_OSS_BUCKET'),
            // The endpoint of OSS, E.g: oss-cn-hangzhou.aliyuncs.com> OR your custom domain, E.g:img.abc.com',
            'endpoint'      => env('ALIYUN_OSS_ENDPOINT'),
            // true if use custom domain as endpoint or false
            'is_cname'       => env('ALIYUN_OSS_IS_CNAME'),
            // <true|false>
            'debug'         => env('ALIYUN_OSS_DEBUG'),
        ],

    ],

];

```

Step4: 代码中使用


参考：[Filesystem / Cloud Storage](https://laravel.com/docs/5.4/filesystem)
