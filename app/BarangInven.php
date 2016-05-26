<?php

namespace App;

use App\BaseModel;

class BarangInven extends BaseModel
{
	public $incrementing = false;
    protected $table = 'barang_inven';
    protected $primaryKey = 'idBarang';
    protected $fillable = array('idBarang','kodeBarang','namaBarang','keterangan','isDeleted','createdBy','createDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function InvenMasuk(){
    	return $this->hasMany('App\InvenMasuk','fk_barang');
    }
}
