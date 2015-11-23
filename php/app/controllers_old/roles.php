<?php
/**
 * @class Roles
 * A simple application controller extension
 */
class Roles extends ApplicationController {
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

		$_result = $_db->query("SELECT id, company, module, code, name, is_visible, position FROM roles ORDER BY position ASC") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}

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

		if($stmt = $_db->prepare("INSERT INTO roles (company, module, code, name, is_visible, position) VALUES (?, ?, ?, ?, ?, ?)")) {

			$stmt->bind_param('ddsssd', $company, $module, $code, $name, $is_visible, $position);

			$company  = $_db->real_escape_string($this->params->company);
			$module  = $_db->real_escape_string($this->params->module);
			$code  = $_db->real_escape_string($this->params->code);
			$name  = $_db->real_escape_string($this->params->name);
			$is_visible  = $_db->real_escape_string($this->params->is_visible);
			$position  = $_db->real_escape_string($this->params->position);
			$stmt->execute();


			$_rights = $_db->query("SELECT id FROM rights WHERE module=" . $module);

   error_log ("\r\r" . 'module = ' . $module, 3, '/var/www/errlog.log');


			while ($row = $_rights->fetch_assoc()) {

   error_log ("\r\r" . 'row_id = ' . $row['id'], 3, '/var/www/errlog.log');
 
				$_db->query("INSERT INTO permissions (role, aright) VALUES (" . $stmt->insert_id . "," . $row['id'] . ")");
			}

			$_result = $_db->query("SELECT id, company, module, code, name, is_visible, position FROM roles where id=" . $stmt->insert_id);
			$results = array();

			while ($row = $_result->fetch_assoc()) {
				array_push($results, $row);
			}
			$stmt->close();
		}

 //   error_log ("\r\r" . '$stmt->insert_id = ' . $stmt->insert_id, 3, '/var/www/errlog.log');
 //   error_log ("\r\r" . '$results = ' . json_encode($results), 3, '/var/www/errlog.log');

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

		if ($stmt = $_db->prepare("UPDATE roles SET company=?, module=?, code=?, name=?, is_visible=?, position=? WHERE id=?")) {

			$stmt->bind_param('ddsssdd', $company, $module, $code, $name, $is_visible, $position, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $company  = $_db->real_escape_string($item->company);
                $module  = $_db->real_escape_string($item->module);
                $code  = $_db->real_escape_string($item->code);
                $name  = $_db->real_escape_string($item->name);
                $is_visible  = $_db->real_escape_string($item->is_visible);
                $position  = $_db->real_escape_string($item->position);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, company, module, code, name, is_visible, position FROM roles where id='$id'");
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

		if($stmt = $_db->prepare("DELETE FROM roles WHERE id = ? LIMIT 1")) {
			$stmt->bind_param('d', $id);
			$stmt->execute();
			$stmt->close();

			$_db->query("DELETE FROM permissions WHERE role ='$id'");
		}

        $res = new Response();
		$res->message = "Record destroyed";
		$res->success = true;

        return $res->to_json();
    }
}