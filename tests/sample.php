<?php

    use \Solenoid\Async\EventLoop;
    use \Solenoid\Async\Promise;



    // (Creating a Loop)
    $loop = EventLoop::create();

    $loop::async
    (
        function () use ($loop)
        {
            // (Getting the value)
            $result = $loop::await
            (
                Promise::create
                (
                    function ($resolve)
                    {
                        // (Calling the function)
                        $resolve('result');
                    }
                )
            )
            ;



            // Printing the value
            echo $result;
        }
    )
    ;



    // (Running the loop)
    $loop->run();

?>