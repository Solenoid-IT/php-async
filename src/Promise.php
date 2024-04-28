<?php



namespace Solenoid\Async;



class Promise
{
    private $function;
    private $result;

    private bool $resolved;



    # Returns [self]
    public function __construct (callable $function)
    {
        // (Getting the value)
        /*$this->function = function ($resolve) use ($function)
        {
            // (Getting the values)
            $resolve_fn = function ($value) use ($resolve)
            {
                // (Calling the function)
                $this->result = $resolve($value);

                // (Setting the value)
                $this->resolved = true;
            }
            ;



            // (Calling the function)
            $function( $resolve_fn );
        }
        ;*/
        $this->function = $function;



        // (Setting the values)
        $this->result   = null;
        $this->resolved = false;
    }

    # Returns [self]
    public static function create (callable $function)
    {
        // Returning the value
        return new Promise( $function );
    }



    # Returns [self]
    public function run ()
    {
        // (Calling the function)
        ($this->function)
        ( 
            function ($value)
            {
                // (Getting the value)
                $this->result = $value;

                // (Setting the value)
                $this->resolved = true;



                // Returning the value
                return $this;
            }
        )
        ;
    }



    # Returns [string]
    public function get_state ()
    {
        // Returning the value
        return $this->resolved ? 'resolved' : 'pending';
    }

    # Returns [mixed]
    public function get_result ()
    {
        // Returning the value
        return $this->result;
    }
}



?>