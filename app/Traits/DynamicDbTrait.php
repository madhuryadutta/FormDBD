<?php

namespace App\Traits;

use mysqli;

trait DynamicDbTrait
{
    public function DatabaseManager($dbname, $sql, $servername = null, $username = null, $password = null)
    {
        if ($servername == null) {
            $servername = env('DB_HOST');
        }
        if ($username == null) {
            $username = env('DB_USERNAME');
        }
        if ($password == null) {
            $password = env('DB_PASSWORD');
        }
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            exit('Connection failed: '.$conn->connect_error);
        }

        $result = $conn->query($sql);

        $results = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }

        return $results;
    }
}
