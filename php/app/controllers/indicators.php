<?php
/**
 * @class Indicators
 * A simple application controller extension
 */
class Indicators extends ApplicationController {
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

		$_result = $_db->query("Select i.id as id, i.parent as parent, i.type as type, i.code as code, i.name as name, i. position as position, '1' as leaf,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-01' AND f.indicator = i.id LIMIT 1) as p1,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-02' AND f.indicator = i.id LIMIT 1) as p2, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-03' AND f.indicator = i.id LIMIT 1) as p3, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-04' AND f.indicator = i.id LIMIT 1) as p4, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-05' AND f.indicator = i.id LIMIT 1) as p5, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-06' AND f.indicator = i.id LIMIT 1) as p6, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-07' AND f.indicator = i.id LIMIT 1) as p7, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-08' AND f.indicator = i.id LIMIT 1) as p8, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-09' AND f.indicator = i.id LIMIT 1) as p9, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-10' AND f.indicator = i.id LIMIT 1) as p10,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-11' AND f.indicator = i.id LIMIT 1) as p11,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-12' AND f.indicator = i.id LIMIT 1) as p12,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-01' AND f.indicator = i.id LIMIT 1) as p13,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-02' AND f.indicator = i.id LIMIT 1) as p14, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-03' AND f.indicator = i.id LIMIT 1) as p15, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-04' AND f.indicator = i.id LIMIT 1) as p16, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-05' AND f.indicator = i.id LIMIT 1) as p17,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-06' AND f.indicator = i.id LIMIT 1) as p18, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-07' AND f.indicator = i.id LIMIT 1) as p19, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-08' AND f.indicator = i.id LIMIT 1) as p20, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-09' AND f.indicator = i.id LIMIT 1) as p21, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-10' AND f.indicator = i.id LIMIT 1) as p22,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-11' AND f.indicator = i.id LIMIT 1) as p23,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-12' AND f.indicator = i.id LIMIT 1) as p24,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-01' AND f.indicator = i.id LIMIT 1) as p25,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-02' AND f.indicator = i.id LIMIT 1) as p26, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-03' AND f.indicator = i.id LIMIT 1) as p27, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-04' AND f.indicator = i.id LIMIT 1) as p28, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-05' AND f.indicator = i.id LIMIT 1) as p29, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-06' AND f.indicator = i.id LIMIT 1) as p30, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-07' AND f.indicator = i.id LIMIT 1) as p31, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-08' AND f.indicator = i.id LIMIT 1) as p32, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-09' AND f.indicator = i.id LIMIT 1) as p33, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-10' AND f.indicator = i.id LIMIT 1) as p34,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-11' AND f.indicator = i.id LIMIT 1) as p35,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-12' AND f.indicator = i.id LIMIT 1) as p36
								  FROM indicators i ORDER BY i.parent, i.id ASC")

		          or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}

//        error_log ("\r" . '$view = ' . json_encode($results), 3,   '/var/www/errlog.log');

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

		if($stmt = $_db->prepare("INSERT INTO indicators (parent, type, code, name, beg_period, end_period, position) VALUES (?, ?, ?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dsssddd', $parent, $type, $code, $name, $beg_period, $end_period, $position);
			$parent  = $_db->real_escape_string($this->params->parentId);
			$type  = $_db->real_escape_string($this->params->type);
			$code  = $_db->real_escape_string($this->params->code);
			$name  = $_db->real_escape_string($this->params->name);
			$beg_period  = $_db->real_escape_string($this->params->beg_period);
			$end_period  = $_db->real_escape_string($this->params->end_period);
			$position  = $_db->real_escape_string($this->params->position);
			$stmt->execute();

			$_result = $_db->query("SELECT i.id as id, i.parent as parent, i.type as type, i.code as code, i.name as name, i. position as position, '1' as leaf,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-01' AND f.indicator = i.id LIMIT 1) as p1,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-02' AND f.indicator = i.id LIMIT 1) as p2, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-03' AND f.indicator = i.id LIMIT 1) as p3, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-04' AND f.indicator = i.id LIMIT 1) as p4, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-05' AND f.indicator = i.id LIMIT 1) as p5, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-06' AND f.indicator = i.id LIMIT 1) as p6, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-07' AND f.indicator = i.id LIMIT 1) as p7, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-08' AND f.indicator = i.id LIMIT 1) as p8, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-09' AND f.indicator = i.id LIMIT 1) as p9, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-10' AND f.indicator = i.id LIMIT 1) as p10,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-11' AND f.indicator = i.id LIMIT 1) as p11,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2010-12' AND f.indicator = i.id LIMIT 1) as p12,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-01' AND f.indicator = i.id LIMIT 1) as p13,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-02' AND f.indicator = i.id LIMIT 1) as p14, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-03' AND f.indicator = i.id LIMIT 1) as p15, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-04' AND f.indicator = i.id LIMIT 1) as p16, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-05' AND f.indicator = i.id LIMIT 1) as p17,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-06' AND f.indicator = i.id LIMIT 1) as p18, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-07' AND f.indicator = i.id LIMIT 1) as p19, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-08' AND f.indicator = i.id LIMIT 1) as p20, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-09' AND f.indicator = i.id LIMIT 1) as p21, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-10' AND f.indicator = i.id LIMIT 1) as p22,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-11' AND f.indicator = i.id LIMIT 1) as p23,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2011-12' AND f.indicator = i.id LIMIT 1) as p24,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-01' AND f.indicator = i.id LIMIT 1) as p25,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-02' AND f.indicator = i.id LIMIT 1) as p26, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-03' AND f.indicator = i.id LIMIT 1) as p27, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-04' AND f.indicator = i.id LIMIT 1) as p28, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-05' AND f.indicator = i.id LIMIT 1) as p29, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-06' AND f.indicator = i.id LIMIT 1) as p30, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-07' AND f.indicator = i.id LIMIT 1) as p31, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-08' AND f.indicator = i.id LIMIT 1) as p32, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-09' AND f.indicator = i.id LIMIT 1) as p33, 
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-10' AND f.indicator = i.id LIMIT 1) as p34,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-11' AND f.indicator = i.id LIMIT 1) as p35,
								       (SELECT f.id FROM periods p, facts f WHERE f.period = p.id and p.code = '2012-12' AND f.indicator = i.id LIMIT 1) as p36
								  FROM indicators i where id=" . $stmt->insert_id);
			$results = array();


			while ($row = $_result->fetch_assoc()) {
				array_push($results, $row);
			}
			$stmt->close();
		}

        error_log ("\r" . '$create = ' . json_encode($results), 3,   '/var/www/errlog.log');

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

		if ($stmt = $_db->prepare("UPDATE indicators SET parent=?, type=?, code=?, name=?, beg_period=?, end_period=?, position=? WHERE id=?")) {

			$stmt->bind_param('dsssdddd', $parent, $type, $code, $name, $beg_period, $end_period, $position, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
                $parent  = $_db->real_escape_string($item->parent);
				$type  = $_db->real_escape_string($item->type);
                $code  = $_db->real_escape_string($item->code);
                $name  = $_db->real_escape_string($item->name);
                $beg_period  = $_db->real_escape_string($item->beg_period);
                $end_period  = $_db->real_escape_string($item->end_period);
                $position  = $_db->real_escape_string($item->position);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, parent, type, code, name, beg_period, end_period, position FROM indicators where id='$id'");
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

		if($stmt = $_db->prepare("DELETE FROM indicators WHERE id = ? LIMIT 1")) {
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