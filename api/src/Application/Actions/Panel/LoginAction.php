<?php

declare(strict_types=1);

namespace App\Application\Actions\Panel;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class LoginAction extends PanelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->getFormData();
        $this->logger->info('Set login');

        $login = false;
        $user_name = '';
        if (isset($_SESSION['is_login']) && $_SESSION['is_login']){
            $login = $_SESSION['is_login'];
            $user_name = $_SESSION['user_name'];
        }
        else if (isset($data['user'], $data['password'])){
            if ($this->userRepository->setUser($data['user'], $data['password'])->login()) {
                $login = true;
                $user_name = $data['user'];
                $_SESSION['is_login'] = true;
                $_SESSION['user_name'] = $data['user'];
                $this->logger->info('User login');
            }
        }

        $view = Twig::fromRequest($this->request);
        return $view->render($this->response, 'panel.html.twig', [
            'login' => $login,
            'user_name' => $user_name
        ]);
    }
}
