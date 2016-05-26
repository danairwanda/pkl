<?php 
namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

trait StringId{
	public static function bootStringId()
	{
		static::creating('App\AutoId@onCreating');
	}
}