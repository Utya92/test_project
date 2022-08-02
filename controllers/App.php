<?php

declare(strict_types=1);

namespace Controllers;

use Repository\UserRepository;
use Services\UserService;

class App {
    public function __construct() {
        $userService = new UserService();
        $userRepository = new UserRepository();
        session_start();

        $check = $userService->checkAuth();

        /**делаем редирект в зависимости авторизирован или нет юзер **/
        if ($check) {
            $userService->forwardTo('static/views/content_page');
        } else {
            $userService->forwardTo('static/views/start_page');
        }

        //условие выполняется, если в суперглобальном массиве пост приходит 2 параметра
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) === 2) {
            $loginData = [
                    'login' => htmlspecialchars(trim($_POST['login'])),
                    'password' => htmlspecialchars(trim($_POST['password']))
            ];
            //сетаем куки и сессию при успешной авторизации
            if ($userService->isLogin($loginData)) {
                $userService->setCookieAndSessionParams($loginData);
            }
        }

        //условие выполняется, если в суперглобальном массиве пост приходит 4 параметра
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) === 4) {
            $regData = [
                    'login' => htmlspecialchars(trim($_POST['login'])),
                    'password' => htmlspecialchars(trim($_POST['password'])),
                    'name' => htmlspecialchars(trim($_POST['name'])),
                    'email' => htmlspecialchars(trim($_POST['email']))
            ];
            if ($userService->noSpaces($regData)) {
                $userRepository->saveUser($regData);
            }
            UserService::sendResponse("space detected");
        }

        //условие выполняется, если в суперглобальном массиве пост приходит 1 параметр
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) === 1) {
            $userService->exitUser();
        }
    }
}


