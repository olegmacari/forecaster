<?php
/**
 * @class Main
 * A simple application controller extension
 */
class Main extends ApplicationController {
	protected $_db;
	protected $_result;
	public $results;

	public function __construct()
	{
		$_db = new mysqli('localhost', 'mano' ,'a', 'mano');

		if ($_db->connect_error) {
			die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		}

		$_db->set_charset("utf8");
		return $_db;
	}

    /**
     * view
     * Retrieves rows from database.
     */
    public function gettree() {

		$_db = $this->__construct();

        $tree = array();
        $companyid = 1;

		$_select = $_db->query("SELECT id, type, shortname FROM companies WHERE parent=" . $companyid . " ORDER BY position ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$branches = array();
		while ($row = $_select->fetch_assoc()) {
		    $branch["id"] = "BRANCH_" . $row["id"];
		    $branch["branchid"] = $row["id"];
		    $branch["type"] = $row["type"];
		    $branch["name"] = $row["shortname"];
		    $branch["leaf"] = true;
			array_push($branches, $branch);
		}
        array_push($tree, array("id"=>"com", "type"=>"COMPANY", "name"=>"Компания", "expanded"=>false, "data"=>$branches));

		$_select = $_db->query("SELECT id, code, name FROM abbreviations where dictionary=0 and company=" . $companyid . " ORDER BY position ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$dictionaries = array();
		while ($row = $_select->fetch_assoc()) {
		    $dictionary["id"] = "DICTIONARY_" . $row["id"];
		    $dictionary["dictionaryid"] = $row["id"];
		    $dictionary["type"] = "ABBREVIATIONS";
		    $dictionary["name"] = $row["name"];
		    $dictionary["leaf"] = true;
			array_push($dictionaries, $dictionary);
		}
        array_push($tree, array("id"=>"dic", "type"=>"DICTIONARY", "name"=>"Справочники", "expanded"=>false, "data"=>$dictionaries));

		$_select = $_db->query("SELECT id, code, name FROM roles ORDER BY position ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$roles = array();
		while ($row = $_select->fetch_assoc()) {
		    $role["id"] = "ROLE_" . $row["id"];
		    $role["roleid"] = $row["id"];
		    $role["type"] = "RIGHTS";
		    $role["name"] = $row["name"];
		    $role["leaf"] = true;
			array_push($roles, $role);
		}
        array_push($tree, array("id"=>"rol", "type"=>"ROLES", "name"=>"Роли и права доступа", "expanded"=>false, "data"=>$roles));

		$_select = $_db->query("SELECT id, profile, logname FROM users ORDER BY logname ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$users = array();
		while ($row = $_select->fetch_assoc()) {
		    $user["id"] = "USER_" . $row["id"];
		    $user["userid"] = $row["id"];
		    $user["type"] = "USER";
		    $user["name"] = $row["logname"];
		    $user["leaf"] = true;
			array_push($users, $user);
		}
        array_push($tree, array("id"=>"usr", "type"=>"USERS", "name"=>"Пользователи", "expanded"=>false, "data"=>$users));

        array_push($tree, array("id"=>"prf", "type"=>"PROFILES", "name"=>"Профили", "leaf"=>true));

        $res = new Response();
        $res->success = true;
        $res->message = "Loaded data";
        $res->data = $tree;

//        error_log ("\r" . '$res->to_json() = ' . $res->to_json(), 3,   '/var/www/examples/writer/errlog.log');

        return $res->to_json();
    }

}

