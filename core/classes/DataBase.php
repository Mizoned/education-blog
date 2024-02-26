<?php

namespace Core\Classes;

class DataBase {

    private array $config;
    private \mysqli $connect;
    private \mysqli_result $stmt;

    public function __construct(array $DBConfig) {
        $this->config = $DBConfig;
    }

    public function init() {
        try {
            $this->connect = new \mysqli($this->config["DB_HOST"], $this->config["DB_USER"], $this->config["DB_PASSWORD"], $this->config["DB_NAME"]);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function query($query): DataBase {
        $this->stmt = $this->connect->query($query);
        return $this;
    }

    public function find(): array {
        if (!empty($row = $this->stmt->fetch_assoc())) {
            return $row;
        } else {
            return [];
        }
    }

    public function findAll(): array {
        $result = [];

        while ($row = $this->stmt->fetch_array()) {
            $result[] = $row;
        }

        return $result;
    }
}