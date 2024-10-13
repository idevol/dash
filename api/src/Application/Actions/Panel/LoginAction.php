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

//            $user = $this->capsule->
//                    table('users')->firstOrNew([
//                        'user' => $data['user'],
//                    ]);
//            if ($user->exists) {
//                $this->logger->info('User exists');
//            } else {
//                $user->password = password_hash($data['password'].$_ENV['DASH_SALT'], PASSWORD_BCRYPT, ['cost'=>12]);
//                $user->save();
//                $this->logger->info('User create');
//            }

            $user = $this->capsule->
                    table('users')->
                    select('user', 'password')->
                    where('user', $data['user'])->
                    first();
            if ($user != null && password_verify($data['password'].$_ENV['DASH_SALT'], $user->password)) {
                $login = true;
                $user_name = $user->user;
                $_SESSION['is_login'] = true;
                $_SESSION['user_name'] = $user->user;
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
