<?php

namespace MLD\Converter\SQL;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

/**
 * Class SQLUpdateConverter
 */
class SQLUpdateConverter extends AbstractSQLConverter
{
    function generateStatement($table, $values, $primaryKeyColumn = null, $primaryKey = -1)
    {
        if ($primaryKeyColumn == null || $primaryKey < 0 || !in_array($primaryKeyColumn, $values)) 
        {
            // throw new Exception('Missing primaryKey and primaryKeyColumn!');
            return null;
        }

        unset($values[$primaryKeyColumn]);
        $builder = new GenericBuilder();
        $query = $builder->update()
                ->setTable($table)
                ->setValues($values)
                ->where()
                ->equals($primaryKeyColumn, $primaryKey)
                ->end();
        $sql = $builder->write($query);   
        $values = $builder->getValues();
        array_walk($values, function(&$value, $key) { $value = '"'.$value.'"'; } );
        return strtr($sql, $values);
    }
}