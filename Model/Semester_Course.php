<?php

class Semester_Course{
    public $id ;
    public $courseId ;
    public $name ;
    public $hours ;
    public $section ;
    public $days ;
    public $time ;
    public $room ;
    public $instructor ;
    public $year ;
    public $semester ;

    public function getCourseId(){
        return $this->courseId;
    }

    public function setCourseId($courseId){
        $this->courseId = $courseId;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getHours(){
        return $this->hours;
    }

    public function setHours($hours){
        $this->hours = $hours;
    }

    public function getSection(){
        return $this->section;
    }

    public function setSection($section){
        $this->section = $section;
    }

    public function getDays(){
        return $this->days;
    }

    public function setDays($days){
        $this->days = $days;
    }

    public function getTime(){
        return $this->time;
    }

    public function setTime($time){
        $this->time = $time;
    }

    public function getRoom(){
        return $this->room;
    }

    public function setRoom($room){
        $this->room = $room;
    }

    public function getInstructor(){
        return $this->instructor;
    }

    public function setInstructor($instructor){
        $this->instructor = $instructor;
    }

    public function getYear(){
        return $this->year;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function getSemester(){
        return $this->semester;
    }

    public function setSemester($semester){
        $this->semester = $semester;
    }


}