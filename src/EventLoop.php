<?php



namespace Solenoid\Async;



use \Solenoid\Async\Queue;
use \Solenoid\Async\Promise;



class EventLoop
{
    private static EventLoop $instance;
    private static Queue     $queue;



    # Returns [self]
    private function __construct ()
    {
        // (Getting the value)
        self::$queue = Queue::create();
    }

    # Returns [self]
    public static function create ()
    {
        if ( !self::$instance ) self::$instance = new EventLoop();



        // Returning the value
        return self::$instance;
    }



    # Returns [self]
    public function run ()
    {
        foreach ( self::$queue->to_array( function ($fiber) { return !$fiber->isStarted(); } ) as $fiber )
        {// Processing each iteration
            // (Starting the fiber)
            $fiber->start();
        }

        while ( self::$queue->to_array( function ($fiber) { return !$fiber->isTerminated(); } ) )



        // Returning the value
        return self::$instance;
    }



    # Returns [Promise|false] | Throws [Exception]
    public static function async (callable $function)
    {
        // (Pushing the value)
        self::$queue->push( new \Fiber( $function ) );



        // (Getting the value)
        $promise = $function();

        if ( get_class( $promise ) !== 'Solenoid\Async\Promise' )
        {// Match failed
            // (Setting the value)
            $message = "UsageError :: Function must return a Promise";

            // Throwing an exception
            throw new \Exception($message);

            // Returning the value
            return false;
        }



        // Returning the value
        return $promise;
    }

    // Returns [mixed]
    public static function await (Promise $promise)
    {
        // (Getting the value)
        $fiber = \Fiber::getCurrent();



        // (Suspending the fiber)
        $fiber->suspend();

        // (Running the promise)
        $promise->run();

        // (Resuming the fiber)
        $fiber->resume();



        // Returning the value
        return $promise->get_result();
    }
}



?>