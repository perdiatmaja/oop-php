<?php
use DBConnector\Builder;
use \Constant;
use DBConnector\Connector;

class BaseController {

    private $dbConnect = null;

    private function buildDB() {
        $this->dbConnect = DBConnector\Builder::username(DB_USERNAME)->password(DB_PASSWORD)->host(DB_HOST)->db(DB_NAME)->build();
    }

    protected function getNumRows($result) {
        return $this->dbConnect->getNumRows($result);
    }

    protected function getList($tabelName) {
        if ($this->dbConnect == null) {
            $this->buildDB();
        }

        return $this->dbConnect->getQueryList("user");
    }
}