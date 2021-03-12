<?php
// Implementar um padrão iterator 
// gastei  horas para fazer.
// exemplo de chamada 8.php


class ElementIterator implements Iterator {
    private $collection;
    private $position = 0;
    private $reverse = false;

    public function __contruct($collection, $reverse = false){
        $this->collection = $collection;
        $this->reverse = $reverse;
    }
    public function rewind(){
        $this->position = $this->reverse ? 
            count($this->collection->getItems()) -1 : 0 ;
    }
    public function current(){
        return $this->collection->getItems()[$this->position];
    }
    public function next(){
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }
    public function key(){
        return $this->position;
    }
    public function valid(){
        return isset($this->collection->getItems()[$this->position]);
    }
}

class LinkedList implements IteratorAggregate{

}



?>