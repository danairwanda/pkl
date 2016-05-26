<?php

namespace App;

use App\BaseModel;

class SwitchSub extends BaseModel
{
    public $incrementing = false;
    protected $table = 'switch_sub';
    protected $primaryKey = 'idSubSwitch';
    protected $fillable	= array('idSubSwitch','fk_SC','fk_switchSub','namaSS','ipSS','fk_merekSS','api_ruangSS','fk_kondisiSS','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function SwitchSub(){
        return $this->hasMany('fk_switchSub','idSubSwitch');
    }
    
    public function KondisiAlat(){
    	return $this->belongsTo('App\KondisiAlat','fk_kondisiSS');
    }

    public function SwitchCore(){
    	return $this->belongsTo('App\SwitchCore','fk_SC');
    }

    public function MerekAlat(){
    	return $this->belongsTo('App\MerekAlat','fk_merekSS');
    }

    public function Hub(){
    	return $this->hasMany('App\Hub','fk_SS');
    }
}
