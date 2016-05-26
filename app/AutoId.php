<?php  
namespace App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class AutoId{
	public function format($prefix, $length, $counter)
	{
		$counter = str_pad($counter,$length, '0', STR_PAD_LEFT);
		return sprintf("%s%s", $prefix, $counter);
	}
	public function onCreating(Eloquent $model)
	{
		$model->incrementing = false;
		$model->{$model->getKeyName()} = $this->format(
				$this->getPrefixId($model),
				$this->getLength() - $this->getPrefixLength(),
				$this->getCounterId($model)
			);
	}

	protected function getPrefixId(Eloquent $model)
	{
		$date = date("Ym");
		// $date = "abc";
		return $date;
	}

	protected function getCounterId(Eloquent $model)
	{
		$lastId = $model->select($model->getKeyName())
			->orderBy($model->getKeyName(), 'desc')
			->first();
			return ($lastId != null)
			? intval(substr($lastId->{$model->getKeyName()}, $this->getPrefixLength())) + 1
			:1;
	}

	protected function getPrefixLength()
	{
		return 6;
	}

	protected function getLength()
	{
		return 15;
	}
}