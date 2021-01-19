<?php declare (strict_types=1);
/**
 * Visitor Class.
 *
 * This file is part of RFHubAPI, please read the documentation
 * available in the root level of this project
 *
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 */

namespace RFHApi\User;

/**
 * class RFHApi\User\UserSession
 *
 * UserSession class
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 16/01/2021 19:31
 */
class UserSession {

	/**
     * Logs a User In
     *
     * @param string $username
     * @param string $password
     */
    public static function login(array $data){
        $username = $data["username"];
        $password = $data["password"];
        $sessionInfo = $data["sessionInfo"] ?? [];
        $accountType = $data["accountType"] ?? 0;

        if (UserSession\Login::isLoginDataValid($username, $password))
        {
            $id = UserAccount\Account::getUserId($username);
            $token = substr(str_shuffle(MD5(microtime())), 0, 50);

            $sessionData = [
            	"token"=>$token,
            	"timestamp"=>microtime(),
            	"sessionInfo"=>$sessionInfo
            ];

            $result = UserSession\Session::save((int)$id, $sessionData);

            UserSession\Session::activate((int)$id, ["sessionId"=>$result["lastInsertId"], "accountType"=>$accountType]);

            return ["status"=>true, "userId"=>$id, "sessionId"=>$result["lastInsertId"], "sessionData"=>$sessionData];
        }

        return ["status"=>false];
    }

    public static function logout(int $userId, array $data){
    	$sessionId = $data["session"];

    	$result = UserSession\Session::deactivate($userId, (int)$sessionId);

    	return $result;
    }

    private static function isTokenValid(int $userId, array $data){
    	return UserSession\Session::isTokenValid($userId, $data);
    }
}