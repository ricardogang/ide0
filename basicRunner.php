<?php 
$pipes ;
function executeCmd($cmd, &$stdout=null, &$stderr=null) {
    echo "COMMAND: ".$cmd."\n" ;
    $proc = proc_open($cmd,[
        1 => ['pipe','w'],
        2 => ['pipe','w'],
    ],$cmdPipes);
    $stdout = stream_get_contents($cmdPipes[1]);
    fclose($cmdPipes[1]);
    $stderr = stream_get_contents($cmdPipes[2]);
    fclose($cmdPipes[2]);
    echo $stdout."\n".$stderr."\n";
    return proc_close($proc);
}

function runProgram($cmd,$send=false,$msg="", &$stdout=null, &$stderr=null) {
    static $proc ;
    static $pipes ;
    static $descr ;
    if (!$send) {
        $descr = array(
            0 => array('pipe','r') ,
            1 => array('pipe','w') ,
            2 => array('pipe','w'));
        try{
            echo "RUNNING: ".$cmd."\n" ;
            //ob_flush();
            //flush();
            $proc=proc_open($cmd,$descr,$pipes);

            fclose($pipes[0]);
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            echo $stdout."\n".$stderr."\n";
            return proc_close($proc);

        /*$proc=proc_open($cmd,$descr,$pipes);
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        echo "out:".$stdout."\nerr:".$stderr."\n";
        return proc_close($proc);*/
        } catch (Exception $e){
            echo "Exception".$e.getMessage() ;
        }
    } else {
        echo "fputs" ;
        fputs($pipes[0], $msg);
        fclose($pipes[0]);
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            echo $stdout."\n".$stderr."\n";
            return proc_close($proc);
    }
}

function sendToProcess($process,$msg) {
    if (is_resource($process)){
        fputs($pipes[0], "");
    }
}

function compile($class,$src){
    file_put_contents($class.".java", $src);
    executeCmd("javac ".$class.".java");
}

function run($class){
    runProgram("java ".$class);
}

if (!empty($_POST)){
    $source=$_POST['source'];
    $action=$_POST['action'];
    $className=$_POST['className'];
    $arguments=$_POST['arguments'];
    if (strlen($source)>0) {
        switch ($action){
            case "compile":
                compile($className,$source);
                break ;
            case "compileAndRun":
                compile($className,$source);
                run($className." ".$arguments);
                break ;
            case "executeCmd":
                executeCmd($source, $out, $err) ;
                break ;
            case "sendToProcess":
                executeCmd($source,$out,$err);
                //runProgram($source,true,$arguments,$source,$source) ;
                break ;
        }
    }
}
?>