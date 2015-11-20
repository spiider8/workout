<?php

namespace App\Model;

/**
 * Zakladni model
 *
 * @author Zbynda Finger
 */
class BaseModel extends \Nette\Object{
    
    /**
     *
     * @var \Nette\Database\Context 
     */
    public $database;
    
    function __construct(\Nette\Database\Context $database) {
        $this->database = $database;
    }
}
