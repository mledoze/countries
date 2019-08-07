<?php

namespace MLD\Converter;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

/**
 * Class SQLInsertConverter
 */
class SQLInsertConverter extends AbstractSQLConverter
{
    function generateStatement($table, $values)
    {
        $builder = new GenericBuilder();
        $query = $builder->insert()
                ->setTable($table)
                ->setValues($values);
        $sql = $builder->write($query);   
        $values = $builder->getValues();
        array_walk($values, function(&$value, $key) { $value = '"'.$value.'"'; } );
        return strtr($sql, $values);
    }
}