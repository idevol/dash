<?php

declare(strict_types=1);

namespace App\Application\Actions\Panel;

use App\Application\Actions\Action;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

abstract class PanelAction extends Action
{
    protected Capsule $capsule;

    public function __construct(LoggerInterface $logger, Capsule $capsule)
    {
        parent::__construct($logger);
        $this->capsule = $capsule;
    }
}
