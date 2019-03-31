<?php
namespace BwwClasses\Data;

class Todo
{
    private $id;
    private $dueDate;
    private $taskTitle;
    private $priorityLevel;
    private $status;
    private $completionPercentage;
    private $notes;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->dueDate = null;
        $this->taskTitle = null;
        $this->priorityLevel = null;
        $this->status = null;
        $this->completionPercentage = null;
        $this->notes = null;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDueDate(){
		return $this->dueDate;
	}

	public function setDueDate($dueDate){
		$this->dueDate = $dueDate;
	}

	public function getTaskTitle(){
		return $this->taskTitle;
	}

	public function setTaskTitle($taskTitle){
		$this->taskTitle = $taskTitle;
	}

	public function getPriorityLevel(){
		return $this->priorityLevel;
	}

	public function setPriorityLevel($priorityLevel){
		$this->priorityLevel = $priorityLevel;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getCompletionPercentage(){
		return $this->completionPercentage;
	}

	public function setCompletionPercentage($completionPercentage){
		$this->completionPercentage = $completionPercentage;
	}

	public function getNotes(){
		return $this->notes;
	}

	public function setNotes($notes){
		$this->notes = $notes;
	}

}
