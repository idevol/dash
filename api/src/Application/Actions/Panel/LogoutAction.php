<?php

declare(strict_types=1);

namespace App\Application\Actions\Panel;

use Psr\Http\Message\ResponseInterface as Response;

class LogoutAction extends PanelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $_SESSION['is_login'] = false;
        $_SESSION['user_name'] = '';

        return $this->response
            ->withHeader('Location', '/api/panel/')
            ->withStatus(302);
    }
}
