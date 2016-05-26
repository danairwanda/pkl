<?php  
	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use App\AutoId;
	use App\StringId;

	class BaseModel extends Model{
		use StringId;
	}