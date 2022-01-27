<?php
require "./vendor/predis/predis/autoload.php";
Predis\Autoloader::register();

try {
    $redis = new Predis\Client([
        "host" => "redis"
    ]);
}
catch (Exception $e) {
    die($e->getMessage());
}

if (!$argv[1]){
    echo "You need inform a path of XML file or -v to see all keys\n";
    die();
}

if ($argv[1] !== "-v") {
    // add
    try {
        
        $redis->del($redis->keys('*'));

        $xmldata = simplexml_load_file($argv[1]) or die("Failed to load");

        $redis->set('subdomains', json_encode($xmldata->subdomains->subdomain));

        foreach ($xmldata->cookies->cookie as $cookie) {
                $redis->set('cookie:' . $cookie->attributes()['name'] . ':' . $cookie->attributes()['host'], $cookie);
        }
        
        echo "\nSuccess!\n";
        echo "\n... Finished\n";


    } catch (Exception $e) {
        die($e->getMessage());
    }
}

if ($argv[1] == "-v") {

    // read
    try {
        echo "\nKEYS \n";        
        foreach ($redis->keys('*') as $keys) {
            echo $keys .  "\n";
        }

    } catch (Exception $e) {
        die($e->getMessage());
    }

}