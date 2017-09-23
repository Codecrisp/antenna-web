<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
	protected $fillable = ['type', 'message', 'outgoing', 'connection_id', 'processed', 'raw'];
    public function getDescription()
	{
		if(!$this->message) return 'Empty request received';
		$params = explode(' ', $this->message);

		if($params[0] == 'time')
			return 'Verified antenna online status';
		if($params[0] == 'serial')
			return 'Antenna has connected';
		if($params[0] == 'version')
			return 'Checked firmware version';
		if($params[0] == 'get_host')
			return 'Requested server host';
		if($params[0] == 'received')
			return 'Pigeon has been recorded';

		return $params[0];
	}

	protected function connection()
	{
		return $this->belongsTo(Connection::class);
	}

	public function getParams()
	{
		return explode(' ', $this->message);
	}

	public function getCommand()
	{
		return $this->getParams()[$this->type];
	}
}
