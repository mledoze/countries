<?php

namespace MLD\Converter;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

/**
 * Class SQLUpdateConverter
 */
class SQLUpdateConverter extends AbstractSQLConverter
{
    function generateStatement($table, $values)
    {
        $builder = new GenericBuilder();
        $query = $builder->update()
                ->setTable($table)
                ->setValues($values)
                ->where()
                ->equals(IDD, $values[IDD])
                ->end();
        $sql = $builder->write($query);   
        $values = $builder->getValues();
        array_walk($values, function(&$value, $key) { $value = '"'.$value.'"'; } );
        return strtr($sql, $values);
    }
}