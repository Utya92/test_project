<?php

declare(strict_types=1);

namespace Repository;

use Services\UserService;

class UserRepository {
    //сохранить юзера в джсон
    function saveUserToJson($user): bool {
        file_put_contents('db/database.json', json_encode($user));
        return true;
    }

    //получить массив юзеров из джсон
    function getUsersFromJson(): array {
        return json_decode(file_get_contents('db/database.json'), true);
    }

    //сохранение юзера
    function saveUser($regData) {
        //ложим всех юзеров из базы джсон
        $users = $this->getUsersFromJson(); //arr
        //для записи в конец списка присваиваем записываему юзеру айди на 1 выше, чем до него существуещему
        $lastId = end($users)['id'] ?? null;
        $regData['id'] = $lastId + 1;
        $isUnique = UserService::isUnique($users, $regData);
        /**если логин и имеил юзера уникальны, записываем юзера в бд переведя массив в джсон
         * предварительно зашифровав его пароль **/
        if ($isUnique) {
            $regData['password'] = md5($regData['password'] . PASSWORD_SALT);
            $users[$regData['id']] = [
                    'id' => $regData['id'],
                    'login' => $regData['login'],
                    'password' => $regData['password'],
                    'name' => $regData['name'],
                    'email' => $regData['email']
            ];
            $this->saveUserToJson($users);
            UserService::sendResponse("user has been saved");
        }
    }
}