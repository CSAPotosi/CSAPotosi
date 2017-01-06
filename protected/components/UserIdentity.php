<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Usuario::model()->findByAttributes(array('nombre_usuario' => $this->username));

		if ($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif ($user->clave !== sha1($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else {
			$this->errorCode=self::ERROR_NONE;
			$this->_id = $user->id_usuario;
			$this->setState('nombre', join(' ', array($user->persona->nombres, $user->persona->primer_apellido)));

		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}