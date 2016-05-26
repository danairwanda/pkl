<?php

namespace App;

use App\BaseModel;

class Provider extends BaseModel
{
	public $incrementing = false;
    protected $table = 'provider';
    protected $primaryKey = 'idProvider';
    protected $fillable = array('idProvider','namaProvider','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function Firewall(){
    	return $this->hasMany('App\Firewall','fk_provider');
    }
}
