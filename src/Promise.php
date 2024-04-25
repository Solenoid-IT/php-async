<?php



namespace Solenoid\Async;



class Promise
{
    public $resolve;
    public $reject;

    public \Fiber $fiber;



    # Returns [self]
    public function __construct (callable $resolve, callable $reject)
    {
        // (Getting the values)
        $this->resolve = $resolve;
        $this->reject  = $reject;
    }

    # Returns [self]
    public static function create (callable $resolve, callable $reject)
    {
        // Returning the value
        return new Promise( $resolve, $reject );
    }
}



?>