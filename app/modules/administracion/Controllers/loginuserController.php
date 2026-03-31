<?php

/**
 *
 */

class Administracion_loginuserController extends Controllers_Abstract
{

	protected $mainModel;
	protected $route;
	protected $_csrf_section = "login_admin";
	public $csrf;

	const CIRCUIT_ENABLED = 1;
	const CIRCUIT_MAX_ATTEMPTS = 5;
	const CIRCUIT_LOCK_SECONDS = 900;
	const CIRCUIT_WINDOW_SECONDS = 900;

	public function init()
	{
		$this->mainModel = new Core_Model_DbTable_User();
		$this->route = "/administracion/users";
		$this->_view->route = $this->route;
		$this->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		parent::init();
	}

	public function indexAction()
	{
		Session::getInstance()->set("error_login", "");

		if (!$this->getRequest()->isPost()) {
			header('Location: /administracion/');
			return;
		}

		$user = trim($this->_getSanitizedParam("user"));
		$password = $this->_getSanitizedParam("password");
		$csrf = $this->_getSanitizedParam("csrf");
		$captcha = $this->_getSanitizedParam("g-recaptcha-response");

		$circuitKey = $this->getCircuitKey($user);
		if (self::CIRCUIT_ENABLED == 1) {
			$circuitState = $this->getCircuitState($circuitKey);
			if ($this->isCircuitOpenState($circuitState)) {
				Session::getInstance()->set("error_login", $this->getCircuitMessage($circuitState['locked_until']));
				header('Location: /administracion/');
				return;
			}
		}

		if (!$user || !$password) {
			$this->rejectLogin($circuitKey, "Completa usuario y contrasena.");
			return;
		}

		if (!$this->isValidCsrf($csrf)) {
			$this->rejectLogin($circuitKey, "Tu sesion expiro. Intenta de nuevo.");
			return;
		}

		if (!$this->verifyCaptcha($captcha)) {
			$this->rejectLogin($circuitKey, "Valida el captcha para continuar.");
			return;
		}

		$userModel = new Core_Model_DbTable_User();
		if ($userModel->autenticateUser($user, $password) !== true) {
			$this->rejectLogin($circuitKey, "El Usuario o Contrasena son incorrectos.");
			return;
		}

		$resUser = $userModel->searchUserByUser($user);
		if (!$resUser || $resUser->user_state != 1) {
			$this->rejectLogin($circuitKey, "El Usuario se encuentra inactivo.");
			return;
		}

		if (self::CIRCUIT_ENABLED == 1) {
			$this->resetCircuit($circuitKey);
		}

		Session::getInstance()->set("kt_login_id", $resUser->user_id);
		Session::getInstance()->set("kt_login_level", $resUser->user_level);
		Session::getInstance()->set("kt_login_user", $resUser->user_user);
		Session::getInstance()->set("kt_login_name", $resUser->user_names . " " . $resUser->user_lastnames);
		session_regenerate_id(true);

		$browserFingerprint = md5(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
		Session::getInstance()->set("kt_login_fingerprint", $browserFingerprint);
		$pathSegments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
		$urlFingerprint = md5('/' . (isset($pathSegments[0]) ? $pathSegments[0] : '') . '/');
		Session::getInstance()->set("kt_login_url_fingerprint", $urlFingerprint);
		//LOG
		$data['log_tipo'] = "LOGIN";
		$data['log_usuario'] = $resUser->user_user;
		$logModel = new Administracion_Model_DbTable_Log();
		$logModel->insert($data);

		if ($resUser->user_level != "11") {
			header("Location: /administracion/panel");
			return;
		}
		header("Location: /administracion/socios");
	}


	public function forgotpasswordAction()
	{
		$this->setLayout('blanco');
		$this->_csrf_section = "login_admin";
		$modelUser = new Core_Model_DbTable_User();
		$email = $this->_getSanitizedParam("email");
		$error = true;
		$message = "Usuario No encontrado";
		$filter = " user_email = '" . $email . "' ";
		$user = $modelUser->getList($filter, "")[0];
		$id = $user->user_id;
		Session::getInstance()->set("error_olvido", $message);
		if ($user) {
			$sendingemail = new Core_Model_Sendingemail($this->_view);
			$code = Session::getInstance()->get('csrf')['page_csrf'];
			$modelUser->editCode($id, $code);
			$user = $modelUser->getById($user->user_id);
			if ($sendingemail->forgotpassword($user) == true) {
				$error = false;
				$message = "Se ha enviado a su correo un mensaje de recuperación de contraseña.";
				Session::getInstance()->set("mensaje_olvido", $message);
				Session::getInstance()->set("error_olvido", "");
			} else {
				$message = "Lo sentimos ocurrio un error y no se pudo enviar su mensaje";
				Session::getInstance()->set("error_olvido", $message);
			}
		}
		header('Location: /administracion/index/olvido');
	}

	public function logoutAction()
	{
		//LOG
		$data['log_tipo'] = "LOGOUT";
		$logModel = new Administracion_Model_DbTable_Log();
		$logModel->insert($data);

		Session::getInstance()->set("kt_login_id", "");
		Session::getInstance()->set("kt_login_level", "");
		Session::getInstance()->set("kt_login_user", "");
		Session::getInstance()->set("kt_login_name", "");
		header('Location: /administracion/');
	}

	private function getClientIp()
	{
		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
	}

	private function getCircuitKey($user)
	{
		$user = is_string($user) ? trim(strtolower($user)) : '';
		$ip = $this->getClientIp();
		if ($user === '') {
			$user = $ip;
		}
		return 'login_admin_' . md5($user . '|' . $ip);
	}

	private function getCircuitState($key)
	{
		if (!isset($_SESSION['login_circuit']) || !is_array($_SESSION['login_circuit'])) {
			$_SESSION['login_circuit'] = array();
		}
		$state = isset($_SESSION['login_circuit'][$key]) && is_array($_SESSION['login_circuit'][$key])
			? $_SESSION['login_circuit'][$key]
			: array('failures' => 0, 'last_failure' => 0, 'locked_until' => 0);

		return $state;
	}

	private function setCircuitState($key, $state)
	{
		if (!isset($_SESSION['login_circuit']) || !is_array($_SESSION['login_circuit'])) {
			$_SESSION['login_circuit'] = array();
		}
		$_SESSION['login_circuit'][$key] = $state;
	}

	private function isCircuitOpenState($state)
	{
		return !empty($state['locked_until']) && $state['locked_until'] > time();
	}

	private function registerCircuitFailure($key)
	{
		$state = $this->getCircuitState($key);
		$now = time();
		if (!empty($state['locked_until']) && $state['locked_until'] > $now) {
			return $state;
		}
		if (!empty($state['last_failure']) && ($now - $state['last_failure']) > self::CIRCUIT_WINDOW_SECONDS) {
			$state['failures'] = 0;
		}
		$state['failures'] = isset($state['failures']) ? (int) $state['failures'] + 1 : 1;
		$state['last_failure'] = $now;
		if ($state['failures'] >= self::CIRCUIT_MAX_ATTEMPTS) {
			$state['locked_until'] = $now + self::CIRCUIT_LOCK_SECONDS;
		}
		$this->setCircuitState($key, $state);

		return $state;
	}

	private function resetCircuit($key)
	{
		$this->setCircuitState($key, array('failures' => 0, 'last_failure' => 0, 'locked_until' => 0));
	}

	private function getCircuitMessage($lockedUntil)
	{
		$minutes = (int) ceil(($lockedUntil - time()) / 60);
		if ($minutes < 1) {
			$minutes = 1;
		}
		return "Demasiados intentos. Intenta de nuevo en " . $minutes . " minutos.";
	}

	private function isValidCsrf($csrf)
	{
		if (!is_string($csrf) || !is_string($this->csrf)) {
			return false;
		}
		return hash_equals($this->csrf, $csrf);
	}

	private function rejectLogin($circuitKey, $message)
	{
		if (self::CIRCUIT_ENABLED == 1) {
			$state = $this->registerCircuitFailure($circuitKey);
			if ($this->isCircuitOpenState($state)) {
				$message = $this->getCircuitMessage($state['locked_until']);
			}
		}
		Session::getInstance()->set("error_login", $message);
		header('Location: /administracion/');
	}

	private function verifyCaptcha($response)
	{
		if (!is_string($response) || trim($response) === '') {
			return false;
		}

		$secretKey = '6LfFDZskAAAAAOvo1878Gv4vLz3CjacWqy08WqYP';
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => $secretKey,
			'response' => $response,
			'remoteip' => $this->getClientIp()
		);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
				'timeout' => 5
			)
		);

		$context = stream_context_create($options);
		$result = @file_get_contents($url, false, $context);
		if ($result === false) {
			return false;
		}
		$response = json_decode($result);

		return isset($response->success) && $response->success === true;
	}
}