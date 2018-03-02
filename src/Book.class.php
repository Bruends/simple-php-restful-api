<?php
  class Book 
  {
    private $id;
    private $title  = "";
    private $author = "";
    private $description = "";

    public function __get($attr){
      return $this->$attr;
    }

    public function __set($attr, $val){
      return $this->$attr = $val;
    }
  }