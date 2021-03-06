<?php

$db = mysqli_connect('localhost', 'root', 'root', 'linkify');
mysqli_set_charset($db, 'utf8');

// Check connection
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: '.mysqli_connect_error();
    die();
}

//Fetches data from the db
function executeGetQuery($db, $query, $single = false)
{
    $result = mysqli_query($db, $query);

    if (!$result) {
        echo 'Something went wrong ->'.mysqli_errors($query);
        die();
    }

  //If we currently fetching a single row, just return one row. Otherwise return all
  $data = ($single) ? mysqli_fetch_assoc($result) : array();

    if (!$single) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    mysqli_free_result($result);

    return $data;
}

//Handles inserts, updates and deletes
function executePosts($db, $query)
{
    $result = mysqli_query($db, $query);

    if (!$result) {
        echo 'Something went wrong -> '.mysqli_errors($query);

        return false;
    } else {
        return $result;
    }
}
