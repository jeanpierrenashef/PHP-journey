<?php
class Node {
    public $value;
    public $next;

    public function __construct($value){
        $this->value =$value;
        $this->next =null;
    }
}

class LinkedList {
    private $head;

    public function __construct(){
        $this->head =null;
    }

    public function add($value) {
        $newNode=new Node($value);
        if ($this->head===null) {
            $this->head =$newNode;
        }
        else{
            $current =$this->head;
            while($current->next!== null){
                $current=$current->next;
            }
            $current->next= $newNode;
        }
    }

    public function printNodesWTwoVowels() {
        $current =$this->head;
        $result =[];
        while ($current !==null) 
        {
            if ($this->countVowels($current->value)=== 2) 
            {
                $result[]=$current->value;
            }
            $current=$current->next;
        }
        return $result;
    }

    private function countVowels($string) {
        $vowels=['a','e','i','o','u'];
        $count =0;
        foreach (str_split(strtolower($string)) as $char)
        {
            if (in_array($char,$vowels))
            {$count++;}
        }
        return $count;
    }
}

$list = new LinkedList();
$list->add("apple");
$list->add("orange");
$list->add("ahmad");
$list->add("bluster");
$list->add("aeiu");


echo json_encode([
    $list->printNodesWTwoVowels()
]);