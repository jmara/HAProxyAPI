<?php
/**
 * HAProxyAPI is a PHP API to access/administrate HAProxy via
 * UNIX Sockets, TCP Sockets and/or the HAProxy HTTP interface.
 * 
 * HAProxyAPI was written by Steve Kamerman, 2012 and is distributed
 * via GitHub at https://github.com/kamermans/HAProxyAPI
 * 
 *  @author Steve Kamerman
 *  @copyright Steve Kamerman, 2012
 *  @license GNU GPLv3
 * 
 * This file is part of HAProxyAPI.
 *
 * HAProxyAPI is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * HAProxyAPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with HAProxyAPI.  If not, see <http://www.gnu.org/licenses/>.
 */
class HAProxy_Stats_Service {
	/**
	 * @var HAProxy_Stats_Info
	 */
	public $info;
	/**
	 * @var HAProxy_Stats_Health
	 */
	public $health;
	/**
	 * @var HAProxy_Stats_Queue
	 */
	public $queue;
	/**
	 * @var HAProxy_Stats_Session
	 */
	public $session;
	/**
	 * @var HAProxy_Stats_Bytes
	 */
	public $bytes;
	/**
	 * @var HAProxy_Stats_Rate
	 */
	public $rate;
	/**
	 * @var HAProxy_Stats_Abort
	 */
	public $abort;
	/**
	 * @var HAProxy_Stats_Denied
	 */
	public $denied;
	/**
	 * @var HAProxy_Stats_Error
	 */
	public $error;
	/**
	 * @var HAProxy_Stats_Warning
	 */
	public $warning;
	/**
	 * @var HAProxy_Stats_HttpResponseCode
	 */
	public $http_response_code;
	
	/**
	 * Creates a new Service Stats object from a given status line
	 * @param HAProxy_Stats_Line $line
	 * @return HAProxy_Stats_Service
	 */
	public static function createFromLine(HAProxy_Stats_Line $line) {
		$instance = new self();
		$instance->setFromLine($line);
		return $instance;
	}
	
	public function setFromLine(HAProxy_Stats_Line $line) {
		$this->info = new HAProxy_Stats_Info($line);
		$this->health = new HAProxy_Stats_Health($line);
		$this->queue = new HAProxy_Stats_Queue($line);
		$this->session = new HAProxy_Stats_Session($line);
		$this->bytes = new HAProxy_Stats_Bytes($line);
		$this->rate = new HAProxy_Stats_Rate($line);
		$this->abort = new HAProxy_Stats_Abort($line);
		$this->denied = new HAProxy_Stats_Denied($line);
		$this->error = new HAProxy_Stats_Error($line);
		$this->warning = new HAProxy_Stats_Warning($line);
		$this->http_response_code = new HAProxy_Stats_HttpResponseCode($line);
	}
	
	public function dump() {
		$out = '';
		$out .= $this->info->dump();
		$out .= $this->health->dump();
		$out .= $this->queue->dump();
		$out .= $this->session->dump();
		$out .= $this->bytes->dump();
		$out .= $this->rate->dump();
		$out .= $this->denied->dump();
		$out .= $this->error->dump();
		$out .= $this->warning->dump();
		$out .= $this->http_response_code->dump();
		return $out;
	}
}