<?php

class EmployeeStore extends ObjectModel
{
    public $name;
    public $nif;
    public $salary;

    public static $definition = [
        'table' => 'physicalstore_employee',
        'primary' => 'id_physicalstore_employee',
        'multilang' => false,
        'multilang_shop' => false,
        'fields' => [
            'name' => [
                'type' => self::TYPE_STRING,
                'validate' => 'isName',
                'size' => '100',
                'required' => true,
                ],
            'nif' => [
                'type' => self::TYPE_STRING,
                'validate' => 'isDniLite',
                'size' => '9',
            ],
            'salary' => [
                'type' => self::TYPE_FLOAT,
                'validate' => 'isPrice',
                'size' => '5',
                'required' => true,
            ],
        ],
    ];
}

/**`id_physicalstore_employee` int(11) NOT NULL AUTO_INCREMENT,
 * `name` varchar(100) NOT NULL,
 * `nif` varchar(9),
 * `salary` float(5) NOT NULL,
 * PRIMARY KEY  (`id_physicalstore_employee`) */
