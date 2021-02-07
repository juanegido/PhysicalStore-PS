<?php

$sql=array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'physicalstore_employee` (
    `id_physicalstore_employee` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `nif` varchar(9),
    `salary` float(5) NOT NULL,
    PRIMARY KEY  (`id_physicalstore_employee`)

) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

foreach ($sql as $query){
    if(Db::getInstance()->execute($query)==false){
        return false;
    }
}
