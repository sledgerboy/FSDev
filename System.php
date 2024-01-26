<?php



class System Extends TableMaker {

    /**
     * init для БД
     * @return mysqli
     */
    public function sqlConnect() {
        $mysqliConnect = new mysqli("localhost", "root", "root", "FSDEV");
        return $mysqliConnect;
    }

}