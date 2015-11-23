
<?php
/**
 * @class Companies
 * A simple application controller extension
 */
class Companies extends ApplicationController {
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
     * get_company
     * Retrieves row from database.
     */
    public function getcompany() {

		$_db = $this->__construct();


		$cid = $this->params['id'];

 //       error_log ("\r" . '$get_company $id = '. json_encode($cid), 3,   '/var/www/errlog.log');

		$_result = $_db->query("SELECT id, type, shortname, fullname, idno, logo, slogan, registered, registration_no, vat_code, bank_code, 
			bank_account, manager, accountant, address, mail, email, phone, fax, www, video, skype, blog, facebook, twiter, process, status 
			FROM companies where id = " . $cid ) 
		or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}

        // error_log ("\r" . '$get_company $result = '. json_encode($results), 3,   '/var/www/errlog.log');

        $res = new Response();
        $res->success = true;
        $res->message = "Company loaded";
        $res->data = $results[0];

        error_log ("\r" . '$get_company $res1 = '. json_encode($res), 3,   '/var/www/errlog.log');

        return $res->to_json();
    }

    /**
     * view
     * Retrieves rows from database.
     */
    public function view() {

		$_db = $this->__construct();

		$_result = $_db->query("SELECT id, type, shortname, fullname, idno, logo, slogan, registered, registration_no, vat_code, bank_code, 
			bank_account, manager, accountant, address, mail, email, phone, fax, www, video, skype, blog, facebook, twiter, process, status, 
			position FROM companies ORDER BY position ASC") 
		or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		
		$results = array();

		while ($row = $_result->fetch_assoc()) {
			array_push($results, $row);
		}

       // error_log ("\r" . '$view 555= ', 3,   '/var/www/errlog.log');

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

		if($stmt = $_db->prepare("INSERT INTO companies (type, shortname, fullname, idno, logo, slogan, registered, registration_no, vat_code, 
			bank_code, bank_account, manager, accountant, address, mail, email, phone, fax, www, video, skype, blog, facebook, twiter, process, 
			status, position) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

			$stmt->bind_param('dssssssssssddsssssssssssddd', $type, $shortname, $fullname, $idno, $logo, $slogan, $registered, $registration_no, 
				$vat_code, $bank_code, $bank_account, $manager, $accountant, $address, $mail, $email, $phone, $fax, $www, $video, $skype, $blog, 
				$facebook, $twiter, $process, $status, $position);

			$type  = $_db->real_escape_string($this->params->type);
			$shortname  = $_db->real_escape_string($this->params->shortname);
			$fullname  = $_db->real_escape_string($this->params->fullname);
			$idno  = $_db->real_escape_string($this->params->idno);
			$logo  = $_db->real_escape_string($this->params->logo);
			$slogan  = $_db->real_escape_string($this->params->slogan);
			$registered  = $_db->real_escape_string($this->params->registered);
			$registration_no  = $_db->real_escape_string($this->params->registration_no);
			$vat_code  = $_db->real_escape_string($this->params->vat_code);
			$bank_code  = $_db->real_escape_string($this->params->bank_code);
			$bank_account  = $_db->real_escape_string($this->params->bank_account);
			$manager  = $_db->real_escape_string($this->params->manager);
			$accountant  = $_db->real_escape_string($this->params->accountant);
			$address  = $_db->real_escape_string($this->params->address);
			$mail  = $_db->real_escape_string($this->params->mail);
			$email  = $_db->real_escape_string($this->params->email);
			$phone  = $_db->real_escape_string($this->params->phone);
			$fax  = $_db->real_escape_string($this->params->fax);
			$www  = $_db->real_escape_string($this->params->www);
			$video  = $_db->real_escape_string($this->params->video);
			$skype  = $_db->real_escape_string($this->params->skype);
			$blog  = $_db->real_escape_string($this->params->blog);
			$facebook  = $_db->real_escape_string($this->params->facebook);
			$twiter  = $_db->real_escape_string($this->params->twiter);
			$process  = $_db->real_escape_string($this->params->process);
			$status  = $_db->real_escape_string($this->params->status);
			$position  = $_db->real_escape_string($this->params->position);

			$stmt->execute();

			$_result = $_db->query("SELECT id, type, shortname, fullname, idno, logo, slogan, registered, registration_no, vat_code, bank_code, 
			bank_account, manager, accountant, address, mail, email, phone, fax, www, video, skype, blog, facebook, twiter, process, status, 
			position FROM companies where id=" . $stmt->insert_id);
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

		if ($stmt = $_db->prepare("UPDATE companies SET type=?, shortname=?, fullname=?, idno=?, logo=?, slogan=?, registered=?, registration_no=?, 
			vat_code=?, bank_code=?, bank_account=?, manager=?, accountant=?, address=?, mail=?, email=?, phone=?, fax=?, www=?, video=?, skype=?, 
			blog=?, facebook=?, twiter=?, process=?, status=?, position=? WHERE id=?")) {

			$stmt->bind_param('dssssssssssddsssssssssssdddd', $type, $shortname, $fullname, $idno, $logo, $slogan, $registered, $registration_no, 
				$vat_code, $bank_code, $bank_account, $manager, $accountant, $address, $mail, $email, $phone, $fax, $www, $video, $skype, $blog, 
				$facebook, $twiter, $process, $status, $position, $id);

			$results = array();
			$params = array();

            if (count($this->params) < 2) array_push($params, $this->params);
            else $params = $this->params;

            foreach($params as $item)
              {
				$type  = $_db->real_escape_string($item->type);
				$shortname  = $_db->real_escape_string($item->shortname);
				$fullname  = $_db->real_escape_string($item->fullname);
				$idno  = $_db->real_escape_string($item->idno);
				$logo  = $_db->real_escape_string($item->logo);
				$slogan  = $_db->real_escape_string($item->slogan);
				$registered  = $_db->real_escape_string($item->registered);
				$registration_no  = $_db->real_escape_string($item->registration_no);
				$vat_code  = $_db->real_escape_string($item->vat_code);
				$bank_code  = $_db->real_escape_string($item->bank_code);
				$bank_account  = $_db->real_escape_string($item->bank_account);
				$manager  = $_db->real_escape_string($item->manager);
				$accountant  = $_db->real_escape_string($item->accountant);
				$address  = $_db->real_escape_string($item->address);
				$mail  = $_db->real_escape_string($item->mail);
				$email  = $_db->real_escape_string($item->email);
				$phone  = $_db->real_escape_string($item->phone);
				$fax  = $_db->real_escape_string($item->fax);
				$www  = $_db->real_escape_string($item->www);
				$video  = $_db->real_escape_string($item->video);
				$skype  = $_db->real_escape_string($item->skype);
				$blog  = $_db->real_escape_string($item->blog);
				$facebook  = $_db->real_escape_string($item->facebook);
				$twiter  = $_db->real_escape_string($item->twiter);
				$process  = $_db->real_escape_string($item->process);
				$status  = $_db->real_escape_string($item->status);
				$position  = $_db->real_escape_string($item->position);
                //cast id to int
                $id = (int) $item->id;

    			$stmt->execute();
    			$_result = $_db->query("SELECT id, type, shortname, fullname, idno, logo, slogan, registered, registration_no, vat_code, bank_code, 
					bank_account, manager, accountant, address, mail, email, phone, fax, www, video, skype, blog, facebook, twiter, process, status, 
					position FROM companies where id='$id'");
				array_push($results, $_result->fetch_assoc());
              }

			$stmt->close();
		}

        error_log ("\r" . '$update_company $results = '. json_encode($results), 3,   '/var/www/errlog.log');


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

		if($stmt = $_db->prepare("DELETE FROM companies WHERE id = ? LIMIT 1")) {
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