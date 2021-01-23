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
 * class RFHApi\User\UserAccount
 *
 * UserAccount Visitor
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 16/01/2021 02:44
 */
class UserAccount {

	/**
     * Creates new user account and sets user account type
     * by registering new database entries only if provided email does not
     * exist in the database
     *
     * @param array $data
     *
     * @return array
     */
	public function newAccount(array $data){
		$return_result = ["status"=>false, "reason"=>"Invalid data provided"];

		if (isset($data["email"]) && isset($data["password"]) && isset($data["accountType"]) && !is_null($data["password"])){
			$return_result = ["status"=>false, "reason"=>"Account already exists"];

			if (!UserAccount\Account::checkAccountExistsByEmail($data["email"])){
				$return_result = ["status"=>false, "reason"=>"User account was not created"];
				
				$result = UserAccount\Account::newAccount($data["email"], $data["password"]);
				if ($result["lastInsertId"]){
					$accountId = $result["lastInsertId"];
					$accountType = $data["accountType"];
					$setType = UserAccount\AccountType::addAccountType((int)$accountId, (int)$accountType);

					$return_result = ["status"=>true, "accountDetails"=>["id"=>$accountId]];
				}	
			}
		}

		return $return_result;
	}

	public function viewAccounts(){
	}

	/**
     * Assigns an account type to a user account
     *
     * The relationship between users and account types is one to many.
     *
     * @param int $resourceId User Id
     * @param array $data
     *
     * @return array
     */
	public function addUserAccountType(int $resourceId, array $data){
		$addType = UserAccount\AccountType::addAccountType((int)$resourceId, (int)$data["accountType"]);

		if ($addType["lastInsertId"]){
			return ["status"=>true];
		}

		return ["status"=>false, "reason"=>"A database write error occurred"];
	}

	public function viewUserAccountTypes(int $resourceId){
		return UserAccount\AccountType::viewAccountTypes($resourceId);	
	}

	public function addAccountType(int $resourceId, array $data){
	}

	public function removeAccountType(int $resourceId, array $data){
	}
}