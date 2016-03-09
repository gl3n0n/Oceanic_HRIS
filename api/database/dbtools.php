<?php
require_once('MDB2.php');

function connect()
{
    $dsn = array(
        'phptype' => 'mysql',
        'username' => DB_USER,
        'password' => DB_PASS,
        'hostspec' => DB_HOST,
        'database' => DB_NAME,
    );
    $db =& MDB2::connect($dsn);
    if(MDB2::isError($db)) {
            die($db->getMessage());
    }
    $db->loadModule('Extended');
    return $db;
}


function execute_query($conn,$sql,$value_array)
{
    if((sizeof($value_array) >0) && ($value_array!='')) {
       $stmt = $conn->prepare($sql);
       $resultset = $stmt->execute($value_array);
       $stmt->free();
    }
    else
    {
        $resultset = $conn->query($sql);
    }

    // if(PEAR::isError($resultset)) {
    //     die("Error: " . $resultset->getError());
    // }

    return $resultset;
}

function execute_update($conn,$sql,$types,$value_array)
{
    if((sizeof($value_array) >0) && ($value_array!='')) {
        $stmt = $conn->prepare($sql,$types,MDB2_PREPARE_MANIP);
        $resultset = $stmt->execute($value_array);
        $stmt->free();
        }

    if(PEAR::isError($resultset)) {
         die("Error: " . $resultset->getMessage());
    }
    return $resultset;
}
?>
