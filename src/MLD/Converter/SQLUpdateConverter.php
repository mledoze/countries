<?php

namespace MLD\Converter;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

/**
 * Class SQLUpdateConverter
 */
class SQLUpdateConverter extends AbstractSQLConverter
{
    function generateStatement($values)
    {
        $builder = new GenericBuilder();
        $query = $builder->update()
                ->setTable('country')
                ->setValues($values)
                ->where()
                ->equals(CIOC, $values[CIOC])
                ->end();
        $sql = $builder->write($query);   
        $values = $builder->getValues();
        array_walk($values, function(&$value, $key) { $value = '"'.$value.'"'; } );
        return strtr($sql, $values);
    }
}