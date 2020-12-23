<?php

declare(strict_types=1);

namespace App\Providers;

use App\Config\Config;
use App\Config\Loaders\ArrayLoader;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ConfigServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'config',
    ];

    public function register(): void
    {
        $container = $this->getContainer();

        $container->share('config', static function () {
            $loader = new ArrayLoader([
                'app' => base_path('config/app.php'),
                'cache' => base_path('config/cache.php'),
                'db' => base_path('config/db.php'),
            ]);

            return (new Config())->load([$loader]);
        });
    }
}
