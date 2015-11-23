<?php
/**
 * @class Statuses
 * A simple application controller extension
 */
class Statuses extends ApplicationController {
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
    public function view() {

		$_db = $this->__construct();

//		$process = $this->params[process];
//		$whereclause = "";
//
//		if (!is_null($process)) {
//		    $whereclause = " where module = " . $moduleid . " and employee = " . $employeeid;
//		}
//

		$_result = $_db->query("SELECT s.id as id, s.process as process, p.module as module, s.name as name, s.is_default as is_default, s.is_closed as is_closed, s.position as position 
			                      FROM statuses s, processes p 
			                      WHERE p.id = s.process
			                      ORDER BY position ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}

//        error_log ("\r" . '$view = ', 3,   '/var/www/errlog.log');

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

		if($stmt = $_db->prepare("INSERT INTO statuses (process, name, is_default, is_closed, position) VALUES (?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dsssd', $process,  $name, $is_default, $is_closed, $position);
			$process  = $_db->real_escape_string($this->params->process);
			$name  = $_db->real_escape_string($this->params->name);
			$is_default  = $_db->real_escape_string($this->params->is_default);
			$is_closed  = $_db->real_escape_string($this->params->is_closed);
			$position  = $_db->real_escape_string($this->params->position);
			$stmt->execute();

			$_result = $_db->query("SELECT s.id as id, s.process as process, p.module as module, s.name as name, s.is_default as is_default, s.is_closed as is_closed, s.position as position 
			                      FROM statuses s, processes p 
			                      WHERE p.id = s.process AND s.id=" . $stmt->insert_id);
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

        error_log ("\r" . 'update stanus = ', 3,   '/var/www/errlog.log');

		if ($stmt = $_db->prepare("UPDATE statuses SET process=?, name=?, is_default=?, is_closed=?, position=? WHERE id=?")) {

			$stmt->bind_param('dsssdd', $process,  $name, $is_default, $is_closed, $position, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $process  = $_db->real_escape_string($item->process);
                $name  = $_db->real_escape_string($item->name);
                $is_default  = $_db->real_escape_string($item->is_default);
                $is_closed  = $_db->real_escape_string($item->is_closed);
                $position  = $_db->real_escape_string($item->position);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT s.id as id, s.process as process, p.module as module, s.name as name, s.is_default as is_default, s.is_closed as is_closed, s.position as position 
			                      FROM statuses s, processes p 
			                      WHERE p.id = s.process AND s.id='$id'");
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

		if($stmt = $_db->prepare("DELETE FROM statuses WHERE id = ? LIMIT 1")) {
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