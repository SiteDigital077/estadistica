<?php

namespace DigitalsiteSaaS\Estadistica\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model

{
	use UsesTenantConnection;

	protected $table = 'estadistica';
	public $timestamps = false;

	
}