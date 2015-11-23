<?php
/**
 * @class Modules
 * A simple application controller extension
 */
class Modules extends ApplicationController {
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


		$_result = $_db->query("SELECT id, company, code, name, is_enabled, position FROM modules WHERE company = 1 ORDER BY position ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
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

		if($stmt = $_db->prepare("INSERT INTO modules (company, code, name, is_enabled, position) VALUES (?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dsssd', $company, $code, $name, $is_enabled, $position);
			$company  = $_db->real_escape_string($this->params->company);
			$code  = $_db->real_escape_string($this->params->code);
			$name  = $_db->real_escape_string($this->params->name);
			$is_enabled  = $_db->real_escape_string($this->params->is_enabled);
			$position  = $_db->real_escape_string($this->params->position);
			$stmt->execute();

			$_result = $_db->query("SELECT id, company, code, name, is_enabled, position FROM modules where id=" . $stmt->insert_id);
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

		if ($stmt = $_db->prepare("UPDATE modules SET company=?, code=?, name=?, is_enabled=?, position=? WHERE id=?")) {

			$stmt->bind_param('dsssdd', $company, $code, $name, $is_enabled, $position, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $company  = $_db->real_escape_string($item->company);
                $code  = $_db->real_escape_string($item->code);
                $name  = $_db->real_escape_string($item->name);
				$is_enabled  = $_db->real_escape_string($item->is_enabled);
                $position  = $_db->real_escape_string($item->position);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, company, code, name, is_enabled, position FROM modules where id='$id'");
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

		if($stmt = $_db->prepare("DELETE FROM modules WHERE id = ? LIMIT 1")) {
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