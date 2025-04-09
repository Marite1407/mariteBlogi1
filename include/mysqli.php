<?php
class DB {
    private $con; // ühendus salvestatakse siia (private connection)

    function __construct() {
        $this->con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if($this->con->connect_errno) {
            echo "<strong>Viga andmebaasiga:</strong> ".$this->con->connect_errno;
        } else {
            mysqli_set_charset($this->con, "utf8");
        }
    }

    # UPDATE, INSERT või DELETE sql lausete jaoks
    function dbQuery($sql) {
        if($this->con) {
            $res = mysqli_query($this->con, $sql);
            if($res === false) {
                echo "<div>Vigane päring: " .htmlspecialchars($sql). "</div>";
                return false;
            }
            return $res; // tagastab objekti
        }
        return false;
    }

    # SELECT sql lause jaoks
    function dbGetArray($sql) {
        $res = $this->dbQuery($sql);
        if($res !== false) {
            $data = array(); //tühja massiivi loomine
            while($row = mysqli_fetch_assoc($res)) {
                $data[] = $row; // lisa uude massiivi
            }
            return (!empty($data)) ? $data : false; // kui $data pole tühi, tagasta data
        }
        return false;
    }

    # $_POST (vormi andmed) / $_GET (URL andmed) väärtuse tagastamine
    # ?string saab olla post, get ja null (vaikimisi)
    function getVar(string $name, ?string $method = null) {
        if($method === 'post') {
            return $_POST[$name] ?? null;
        } elseif($method === 'get') {
            return $_GET[$name] ?? null;
        } else {
            return $_POST[$name] ?? $_GET[$name] ?? null;
        }

    }    

    # Sisendi turvalisemaks muutmine
    function dbFIX($var) {
        if(!$this->con || !($this->con instanceof mysqli)) { // || või/or
            return 'NULL';
        }
        
        if(is_null($var)) {
            return 'NULL';
        } elseif(is_bool($var)) {
            return $var ? '1' : '0'; // ? kui on tõene ja : kui on väär
        } elseif(is_numeric($var)) {
            return $var;
        } else {
            return $this->con->real_escape_string($var);
        }
    }

    #inimlikul kujul massiivi sisu vaatamine
    function show($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }


} // class Db lõpp 