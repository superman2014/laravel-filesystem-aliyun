<?php

namespace Superman2014\Filesystem\Aliyun;

use Superman2014\Filesystem\Aliyun\Plugins\PutFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use OSS\OssClient;

class AliyunServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend(
            'aliyun',
            function ($app, $config) {
                $adapter = new AliOssAdapter(
                    $client = new OssClient(
                        $config['access_key'],
                        $config['access_secert'],
                        $config['endpoint'],
                        $config['is_cname']
                    ),
                    $config['bucket'],
                    $config['debug']
                );

                $filesystem = new Filesystem($adapter);

                $filesystem->addPlugin(new PutFile());

                return $filesystem;
            }
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
