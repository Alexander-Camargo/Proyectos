<?php
class Database {
    private $host;
    private $user;
    private $password;
    private $database;
    private $port;
    public $connection;

    // Constructor
    public function __construct($host, $user, $password, $database, $port = 3307) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
        $this->connect();
    }

    // Método para establecer la conexión
    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            throw new Exception("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    // Método para cerrar la conexión
    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>