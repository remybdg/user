<?php

namespace Core\DB;

abstract class AbstractModel {
		protected $db;
	
	function __construct() {
		$this->db = new Database;
	}
}