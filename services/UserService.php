<?php

declare(strict_types=1);

namespace Services;

use Repository\UserRepository;

class UserService {
    public bool $isLogin;
    public array $BD;

    function __construct() {
        $userRepository = new UserRepository();
        $this->BD = $userRepository->getUsersFromJson();
    }

    // проверки записываемого в бд  юзер логина и имейла  на уникальность
    static function isUnique($users, $regData): bool {
        foreach ($users as $i) {
            if ($i['login'] === $regData['login']) {
                self::sendResponse('error, login must be unique');
                return false;
            }
            if ($i['email'] === $regData['email']) {
                self::sendResponse('error, email must be unique');
                return false;
            }
        }
        echo('success');
        return true;
    }

    //логика проверки при входе, если введенные данные совпадают с бд, то юзер авторизирован
    function isLogin(array $loginData): bool {
        $hasEntered = false;
        $users = $this->BD;
        foreach ($users as $i) {
            if (($i['login'] === $loginData['login'])
                    && ($i['password']) === md5($loginData['password'] . PASSWORD_SALT)) {
                $hasEntered = true;

            }
        }
        if (!$hasEntered) {
            self::sendResponse('error');
        }
        return $this->isLogin = $hasEntered;
    }

    //метод перенаправления
    function forwardTo(string $url): void {
        echo "<script>location.href='$url'</script>";
    }

    //запись имени в куки и email в сессию
    function setCookieAndSessionParams(array $loginData) {
        if ($this->isLogin) {
            $users = $this->BD;
            $name = null;
            $email = '';
            foreach ($users as $userFromBD) {
                if ($loginData['login'] === $userFromBD['login']) {
                    $name = $userFromBD['name'];
                    $email = $userFromBD['email'];
                }
            }
            setcookie('name', $name, time() + 3600 * 24, '/');
            $_SESSION['auth_email'] = $email;
        }
    }

    //проверка авторизации юзера на данный момент
    function checkAuth(): bool {
        if (isset($_COOKIE['name'])) {
            echo 'в куках есть юзер';
            return true;
        }
        if (array_key_last($_SESSION) && (array_values($_SESSION)[0])) {
            echo " в сессии есть юзер";
            return true;
        }
        return false;
    }

    //удаление кук и сессии
    function exitUser(): void {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]);
        setcookie("name", "", time() - 3600, "/");
        session_destroy();

    }

    /** алгоритм обнаружения пробелов в values пост массивов, для поднятия перфоманса
     * сразу возвращает фолс при первом пробеле **/
    function noSpaces($regData):bool {
        $arr = array_values($regData);
        $detectSpaces = true;
        foreach ($arr as $i) {
            if (!strpos($i, ' ') == 0) {
                $detectSpaces = false;
                break;
            }
        }
        return $detectSpaces;
    }

    static function sendResponse($msg) {
        $dat = ["message" => "$msg"];
        echo json_encode($dat);
    }

}