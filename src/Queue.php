<?php



namespace Solenoid\Async;



class Queue
{
    private array $q;



    # Returns [self]
    public function __construct ()
    {
        // (Setting the value)
        $this->q = [];        
    }

    # Returns [self]
    public static function create ()
    {
        // Returning the value
        return new Queue();
    }



    # Returns [int]
    public function push ($value)
    {
        // (Appending the value)
        $this->q[] = $value;



        // Returning the value
        return count( $this->q ) - 1;
    }

    # Returns [mixed]
    public function pop ()
    {
        // (Shifting the array)
        return array_shift( $this->q );
    }



    # Returns [int]
    public function count ()
    {
        // Returning the value
        return count( $this->q );
    }

    # Returns [Queue]
    public function filter (callable $condition)
    {
        // (Creating a Queue)
        $queue = Queue::create();

        foreach (array_filter( $this->q, $condition ) as $value)
        {// Processing each entry
            // (Enqueuing the value)
            $queue->push( $value );
        }



        // Returning the value
        return $queue;
    }



    # Returns [array<mixed>]
    public function to_array (callable $filter)
    {
        // Returning the value
        return array_values( array_filter( $this->q, $filter ) );
    }
}



?>