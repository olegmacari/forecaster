<?php
/**
 * @class Users
 * A simple application controller extension
 */
class Users extends ApplicationController {
	protected $_db;
	protected $_result;
	public $results;

	public function __construct()
	{
		$_db = new mysqli('127.0.0.1', 'mano' ,'a', 'mano');


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
    public function view() {

		$_db = $this->__construct();

		$_result = $_db->query("SELECT id, company, logname, password, profile, timezone, notifications, is_admin, lastlogin, locked, process, status FROM users ORDER BY logname ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}

		error_log ("\r\r" . '$users = ' . json_encode($results), 3, '/var/www/errlog.log');

        $res = new Response();
        $res->success = true;
        $res->message = "Data loaded";
        $res->data = $results;

        return $res->to_json();
    }

   /**
     * create
     */
    public function create() {

		$_db = $this->__construct();

		if($stmt = $_db->prepare("INSERT INTO users (company, logname, password, profile, timezone, notifications, is_admin, lastlogin, locked, process, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dssdsssssdd', $company, $logname, $password, $profile, $timezone, $notifications, $is_admin, $lastlogin, $locked, $process, $status);
			$company  = $_db->real_escape_string($this->params->company);
			$logname  = $_db->real_escape_string($this->params->logname);
			$password  = $_db->real_escape_string($this->params->password);
			$profile  = $_db->real_escape_string($this->params->profile);
			$timezone  = $_db->real_escape_string($this->params->timezone);
			$notifications  = $_db->real_escape_string($this->params->notifications);
			$is_admin  = $_db->real_escape_string($this->params->is_admin);
			$lastlogin  = $_db->real_escape_string($this->params->lastlogin);
			$locked  = $_db->real_escape_string($this->params->locked);
			$process  = $_db->real_escape_string($this->params->process);
			$status  = $_db->real_escape_string($this->params->status);
			$stmt->execute();

			$_result = $_db->query("SELECT id, company, logname, password, profile, timezone, notifications, is_admin, lastlogin, locked, process, status FROM users where id=" . $stmt->insert_id);
			$results = array();

			while ($row = $_result->fetch_assoc()) {
				array_push($results, $row);
			}
			$stmt->close();
		}

        $res = new Response();
		$res->success = true;
		$res->data = $results;
		$res->message = "Record created";

        return $res->to_json();
    }

    /**
     * update
     */
    public function update() {

		$_db = $this->__construct();

		if ($stmt = $_db->prepare("UPDATE users SET company=?, logname=?, password=?, profile=?, timezone=?, notifications=?, is_admin=?, lastlogin=?, locked=?, process=?, status=? WHERE id=?")) {

			$stmt->bind_param('dssdsssssddd', $company, $logname, $password, $profile, $timezone, $notifications, $is_admin, $lastlogin, $locked, $process, $status, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $company  = $_db->real_escape_string($this->params->company);
                $logname  = $_db->real_escape_string($this->params->logname);
                $password  = $_db->real_escape_string($this->params->password);
                $profile  = $_db->real_escape_string($this->params->profile);
                $timezone  = $_db->real_escape_string($this->params->timezone);
                $notifications  = $_db->real_escape_string($this->params->notifications);
                $is_admin  = $_db->real_escape_string($this->params->is_admin);
                $lastlogin  = $_db->real_escape_string($this->params->lastlogin);
                $locked  = $_db->real_escape_string($this->params->locked);
                $process  = $_db->real_escape_string($this->params->process);
                $status  = $_db->real_escape_string($this->params->status);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, company, logname, password, profile, timezone, notifications, is_admin, lastlogin, locked, process, status FROM users where id='$id'");
				array_push($results, $_result->fetch_assoc());
              }

			$stmt->close();
		}

        $res = new Response();
		$res->success = true;
		$res->data = $results;
		$res->message = "Record updated";

        return $res->to_json();
    }

    /**
     * destroy
     */
    public function destroy() {

		$_db = $this->__construct();

		$id = (int) $this->params->id;

		if($stmt = $_db->prepare("DELETE FROM users WHERE id = ? LIMIT 1")) {
			$stmt->bind_param('d', $id);
			$stmt->execute();
			$stmt->close();
		}

        $res = new Response();
		$res->message = "Record destroyed";
		$res->success = true;

        return $res->to_json();
    }
}