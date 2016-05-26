<?php

namespace App;

use App\BaseModel;

class Firewall extends BaseModel
{
    public $incrementing = false;
    protected $table = 'firewall';
    protected $primaryKey = 'idFirewall';
    protected $fillable = array('idFirewall','fk_provider','namaFirewall', 'ipFirewall','fk_merekFW','api_ruangFW','fk_kondisiFW','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false; 

    public function Provider(){
    	return $this->belongsTo('App\Provider','fk_provider');
    }

    public function KondisiAlat(){
    	return $this->belongsTo('App\KondisiAlat','fk_kondisiFW');
    }

    public function SwitchCore(){
        return $this->hasMany('App\SwitchCore','fk_firewall');
    }
}
