<?php

class FeatureItem {
	public $id = null;
	public $image;
	public $header;
	public $text;

	static protected $table = 'feature_items';

	public function __construct($id = false)
	{
		DB::connect();
		if($id)
		{
			$this->id = (int) $id;
			$this->get();
		}
	}	

	public function __destruct()
	{
		// Db::disconnect();
	}

	public function get()
	{
		if(is_null($this->id))
			throw new Exception('No ID passed');
		$table = self::$table;
		$sql = "
			SELECT * 
			FROM `{$table}`
			WHERE `id` = {$this->id}
			LIMIT 1
		";
		$result = Db::$instance->query($sql);
		$row = $result->fetch_assoc();

		$this->populate($row);
	}

	static public function all()
	{
		DB::connect();
		$table = self::$table;
		$sql = "
			SELECT * 
			FROM `{$table}`
		";
		$result = Db::$instance->query($sql);
		$data = [];

		while($row = $result->fetch_assoc())
		{
			$feature_item = new FeatureItem;
			$feature_item->populate($row);
			$data[] = $feature_item;
			unset($feature_item);
		}
		return $data;
	}

	public function save()
	{
		if(is_null($this->id))
		{
			$table = self::$table;
			$sql = "
				INSERT INTO `{$table}`
				(`image`, `header`, `text`)
				VALUES (
					'{$this->image}',
					'{$this->header}',
					'{$this->text}'
				)
			";

			echo '<pre>';
			var_dump($sql);
			echo '</pre>';
		}
		else
		{
			$table = self::$table;
			$sql = "
				UPDATE `{$table}`
				SET
					`image` = '{$this->image}',
					`header` = '{$this->header}',
					`text` = '{$this->text}'
				WHERE `id` = '{$this->id}'
			";

			echo '<pre>';
			var_dump($sql);
			echo '</pre>';
		}
			Db::$instance->query($sql);
	}

	public function populate($data)
	{
		foreach($data as $key => $value)
			$this->$key = $value;
	}

	public function delete($id)
	{
		if($id)
		{
			$table = self::$table;
			$rowExist = "SELECT `id` FROM `{$table}` WHERE `id` = '$id'";
			$result = Db::$instance->query($rowExist);
			$rowExist = $result->fetch_assoc();

			if ($rowExist == NULL)
				echo 'Строки № ' . $id . ' не существует!';
			else
			{
				$sql = "
					DELETE FROM `{$table}`
					WHERE `id` = '$id'
				";
				Db::$instance->query($sql);
				echo 'Строка № ' . $id . ' удалена!';
			}
		}
	}
}