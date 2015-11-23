<?php
/**
 * @class Periods
 * A simple application controller extension
 */
class Periods extends ApplicationController {
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

		$_result = $_db->query("SELECT id, parent, type, code, year, quarter, month, week, day, '1' as leaf FROM periods") or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
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

		if($stmt = $_db->prepare("INSERT INTO periods (parent, type, code, year, quarter, month, week, day) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dsssssss', $parent, $type, $code, $year, $quarter, $month, $week, $day);
			$parent  = $_db->real_escape_string($this->params->parent);
			$type  = $_db->real_escape_string($this->params->type);
			$code  = $_db->real_escape_string($this->params->code);
			$year  = $_db->real_escape_string($this->params->year);
			$quarter  = $_db->real_escape_string($this->params->quarter);
			$month  = $_db->real_escape_string($this->params->month);
			$week  = $_db->real_escape_string($this->params->week);
			$day  = $_db->real_escape_string($this->params->day);
			$stmt->execute();

			$_result = $_db->query("SELECT id, parent, type, code, year, quarter, month, week, day, '1' as leaf FROM periods where id=" . $stmt->insert_id);
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

		if ($stmt = $_db->prepare("UPDATE periods SET parent=?, type=?, code=?, year=?, quarter=?, month=?, week=?, day=? WHERE id=?")) {

			$stmt->bind_param('dsssssssd', $parent, $type, $code, $year, $quarter, $month, $week, $day, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $parent  = $_db->real_escape_string($item->parent);
				$type  = $_db->real_escape_string($item->type);
                $code  = $_db->real_escape_string($item->code);
                $year  = $_db->real_escape_string($item->year);
                $quarter  = $_db->real_escape_string($item->quarter);
                $month  = $_db->real_escape_string($item->month);
                $week  = $_db->real_escape_string($item->week);
                $day  = $_db->real_escape_string($item->day);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, parent, type, code, year, quarter, month, week, day, '1' as leaf FROM periods where id='$id'");
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

		if($stmt = $_db->prepare("DELETE FROM periods WHERE id = ? LIMIT 1")) {
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