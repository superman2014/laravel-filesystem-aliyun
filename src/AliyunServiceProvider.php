<?php

namespace Superman2014\Filesystem\Aliyun;

use Superman2014\Filesystem\Aliyun\Plugins\PutFile;
use Superman2014\Filesystem\Aliyun\Plugins\PutRemoteFile;
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
                $client = new OssClient(
                    $config['access_id'],
                    $config['access_key'],
                    $config['endpoint'],
                    $config['isCName']
                );
                $adapter = new AliOssAdapter(
                    $client,
                    $config['bucket'],
                    $config['debug']
                );

                $filesystem = new Filesystem($adapter);

                $filesystem->addPlugin(new PutFile());
                $filesystem->addPlugin(new PutRemoteFile());

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
