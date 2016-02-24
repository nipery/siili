<?php
	class Wod  {
		public $id;
	   	public $title;
	   	public $createdAt;
	   	public $publishAt;

	   	public $workouts = array();

	   	public function __construct($id,$title,$created,$published){
	   		$this->id = $id;
	   		$this->title =$title;
	   		$this->createdAt = $created;
	   		$this->publishAt = $published;
	   	}

	   public function AddWorkout($workout){
	   		$this->workouts[] = $workout;
	   }
	}

	class Wodworkout  {
	   public $subtitle;
	   public $id;
	   public $wod;
	   public $order;

	   public function __construct($wodId,$s,$w,$order){
	   		$this->id = $wodId;
	   		$this->wod = $w;
	   		$this->subtitle =$s;
	   		$this->order =$order;
	   }
	}

?>