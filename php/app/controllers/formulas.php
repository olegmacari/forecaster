<?php
/**
 * @class Formulas
 * A simple application controller extension
 */
class Formulas extends ApplicationController {
	protected $_db;
	protected $_result;
	public $results;

	public function __construct()
	{
		$_db = new mysqli('localhost', 'forecaster' ,'a', 'forecaster');


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

//		$period = $this->params[period];
//		$whereclause = "";
//
//		if (!is_null($period)) {
//		    $whereclause = " where module = " . $moduleid . " and employee = " . $employeeid;
//		}
//

		$_result = $_db->query("SELECT id, period, indicator, expression FROM formulas") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
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

		if($stmt = $_db->prepare("INSERT INTO formulas (period, indicator, expression) VALUES (?, ?, ?)")) {

			$stmt->bind_param('dds', $period, $indicator, $expression);
			$period  = $_db->real_escape_string($this->params->period);
			$indicator  = $_db->real_escape_string($this->params->indicator);
			$expression  = $_db->real_escape_string($this->params->expression);
			$stmt->execute();

			$_result = $_db->query("SELECT id, period, indicator, expression FROM formulas where id=" . $stmt->insert_id);
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

		if ($stmt = $_db->prepare("UPDATE formulas SET period=?, indicator=?, expression=? WHERE id=?")) {

			$stmt->bind_param('ddsd', $period, $indicator, $expression, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $period  = $_db->real_escape_string($item->period);
                $indicator  = $_db->real_escape_string($item->indicator);
                $expression  = $_db->real_escape_string($item->expression);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, period, indicator, expression FROM formulas where id='$id'");
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

		if($stmt = $_db->prepare("DELETE FROM formulas WHERE id = ? LIMIT 1")) {
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