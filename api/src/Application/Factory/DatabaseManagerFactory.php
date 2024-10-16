<?php

declare(strict_types=1);

namespace App\Application\Factory;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DatabaseManagerFactory
{
    public Manager $capsule;

    public function __construct()
    {
         $dbSettings = [
            'driver' => 'sqlite',
            'database' => __DIR__ . '/../../Db/database.sqlite'
        ];

        $manager = new Manager;
        $manager->addConnection($dbSettings);

        $manager->getConnection()->enableQueryLog();

        $manager->setEventDispatcher(new Dispatcher(new Container()));

        $manager->setAsGlobal();
        $manager->bootEloquent();

        $this->capsule = $manager;
    }
}