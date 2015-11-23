
<?php
/**
 * @class Employees
 * A simple application controller extension
 */
class Employees extends ApplicationController {
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

    public function fix_date($date)
    {
        // change field to null, null must be allow in table for date field
        // change blank to null or todays date will be created as default
        if (strchr($date, '1899') != FALSE || empty($date)) {
            return NULL;
        } else {
            $dateTime = new DateTime($date);
            return date_format($dateTime, 'Y-m-d');
        }
    }

    /**
     * view
     * Retrieves rows from database.
     */
    public function view() {

		$_db = $this->__construct();

		$_result = $_db->query("SELECT id, company, type, manager, firstname, middlename, lastname, title, photo, idno, passport_no, 
			passport_issued, passport_office, passport_expired, hired, fired, work_phone, home_phone, mobile_phone, mail, email, 
			language, user, process, status FROM employees ORDER BY lastname ASC") 
		or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}
//        error_log ("\r" . '$view = ', 3,   '/var/www/examples/writer/errlog.log');

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

		if($stmt = $_db->prepare("INSERT INTO employees (company, type, manager, firstname, middlename, lastname, title, photo, idno, passport_no, 
			passport_issued, passport_office, passport_expired, hired, fired, work_phone, home_phone, mobile_phone, mail, email, language, user, 
			process, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dddsssdssssssssssssssddd', $company, $type, $manager, $firstname, $middlename, $lastname, $title, $photo, 
				$idno, $passport_no, $passport_issued, $passport_office, $passport_expired, $hired, $fired, $work_phone, $home_phone, 
				$mobile_phone, $mail, $email, $language, $user, $process, $status);

			$company  = $_db->real_escape_string($this->params->company);
			$type  = $_db->real_escape_string($this->params->type);
			$manager  = $_db->real_escape_string($this->params->manager);
			$firstname  = $_db->real_escape_string($this->params->firstname);
			$middlename  = $_db->real_escape_string($this->params->middlename);
			$lastname  = $_db->real_escape_string($this->params->lastname);
			$title  = $_db->real_escape_string($this->params->title);
			$photo  = $_db->real_escape_string($this->params->photo);
			$idno  = $_db->real_escape_string($this->params->idno);
			$passport_no  = $_db->real_escape_string($this->params->passport_no);
			$passport_issued  = $_db->real_escape_string($this->params->passport_issued);
			$passport_office  = $_db->real_escape_string($this->params->passport_office);
			$passport_expired  = $_db->real_escape_string($this->params->passport_expired);
			$hired  = $_db->real_escape_string($this->params->hired);
			$fired  = $_db->real_escape_string($this->params->fired);
			$work_phone  = $_db->real_escape_string($this->params->work_phone);
			$home_phone  = $_db->real_escape_string($this->params->home_phone);
			$mobile_phone  = $_db->real_escape_string($this->params->mobile_phone);
			$mail  = $_db->real_escape_string($this->params->mail);
			$email  = $_db->real_escape_string($this->params->email);
			$language  = $_db->real_escape_string($this->params->language);
			$user  = $_db->real_escape_string($this->params->user);
			$process  = $_db->real_escape_string($this->params->process);
			$status  = $_db->real_escape_string($this->params->status);

			$stmt->execute();

			$_result = $_db->query("SELECT id, company, type, manager, firstname, middlename, lastname, title, photo, idno, passport_no, 
				passport_issued, passport_office, passport_expired, hired, fired, work_phone, home_phone, mobile_phone, mail, email, 
				language, user, process, status FROM employees where id=" . $stmt->insert_id);
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

		if ($stmt = $_db->prepare("UPDATE employees SET company=?, type=?, manager=?, firstname=?, middlename=?, lastname=?, title=?,
		    photo=?, idno=?, passport_no=?, passport_issued=?, passport_office=?, passport_expired=?, hired=?, fired=?, work_phone=?, 
		    home_phone=?, mobile_phone=?, mail=?, email=?, language=?, user=?, process=?, status=? WHERE id=?")) {

			$stmt->bind_param('dddsssdssssssssssssssdddd', $company, $type, $manager, $firstname, $middlename, $lastname, $title, $photo, 
				$idno, $passport_no, $passport_issued, $passport_office, $passport_expired, $hired, $fired, $work_phone, $home_phone, 
				$mobile_phone, $mail, $email, $language, $user, $process, $status, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
				$company  = $_db->real_escape_string($item->company);
				$type  = $_db->real_escape_string($item->type);
				$manager  = $_db->real_escape_string($item->manager);
				$firstname  = $_db->real_escape_string($item->firstname);
				$middlename  = $_db->real_escape_string($item->middlename);
				$lastname  = $_db->real_escape_string($item->lastname);
				$title  = $_db->real_escape_string($item->title);
				$photo  = $_db->real_escape_string($item->photo);
				$idno  = $_db->real_escape_string($item->idno);
				$passport_no  = $_db->real_escape_string($item->passport_no);
				$passport_issued  = $_db->real_escape_string($item->passport_issued);
				$passport_office  = $_db->real_escape_string($item->passport_office);
				$passport_expired  = $_db->real_escape_string($item->passport_expired);
				$hired  =  $_db->real_escape_string($item->hired);
				$fired  = $_db->real_escape_string($item->fired);
				$work_phone  = $_db->real_escape_string($item->work_phone);
				$home_phone  = $_db->real_escape_string($item->home_phone);
				$mobile_phone  = $_db->real_escape_string($item->mobile_phone);
				$mail  = $_db->real_escape_string($item->mail);
				$email  = $_db->real_escape_string($item->email);
				$language  = $_db->real_escape_string($item->language);
				$user  = $_db->real_escape_string($item->user);
				$process  = $_db->real_escape_string($item->process);
				$status  = $_db->real_escape_string($item->status);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, company, type, manager, firstname, middlename, lastname, title, photo, idno, passport_no, 
    				passport_issued, passport_office, passport_expired, hired, fired, work_phone, home_phone, mobile_phone, mail, email, 
    				language, user, process, status FROM employees where id='$id'");
				array_push($results, $_result->fetch_assoc());
              }

			$stmt->close();
		}

        $res = new Response();
		$res->success = true;
		$res->data = $results;
		$res->message = "Record Updated";

        return $res->to_json();
    }

    /**
     * destroy
     */
    public function destroy() {

		$_db = $this->__construct();

		$id = (int) $this->params->id;

		if($stmt = $_db->prepare("DELETE FROM employees WHERE id = ? LIMIT 1")) {
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