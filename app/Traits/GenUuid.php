<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait GenUuid
{
	protected static function boot()
    {
		parent::boot();
        static::creating(function ($model) {
        	if (empty($model->{$model->getKeyName()})){
        		$model->{$model->getKeyName()} = $model->uid();
        	}
		});
	}

	public function getIncremeting()
	{
		return false;
	}

	public function getKeyType()
	{
		return 'string';
	}

	public function uid($limit = 5)
	{
		return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0,  $limit);
	}
}