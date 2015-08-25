<?php

use Lykegenes\LaravelDatagridBuilder\Datagrid;
use Lykegenes\LaravelDatagridBuilder\DatagridColumn;

if (!function_exists('datagrid'))
{
    function datagrid(Datagrid $datagrid, array $options = [])
    {
        return $datagrid->renderDatagrid($options);
    }
}

if (!function_exists('datagrid_start'))
{
    function datagrid_start(Datagrid $datagrid, array $options = [])
    {
        return $datagrid->renderDatagrid($options, true, false, false);
    }
}

if (!function_exists('datagrid_end'))
{
    function datagrid_end(Datagrid $datagrid, $showFields = true)
    {
        return $datagrid->renderRest(true, $showFields);
    }
}

if (!function_exists('datagrid_rest'))
{
    function datagrid_rest(Datagrid $datagrid)
    {
        return $datagrid->renderRest(false);
    }
}

if (!function_exists('datagrid_until'))
{
    function datagrid_until(Datagrid $datagrid, $column_name)
    {
        return $datagrid->renderUntil($column_name, false);
    }
}

if (!function_exists('datagrid_label'))
{
    function datagrid_label(DatagridColumn $datagridColumn, array $options = [])
    {
        return $datagridColumn->render($options, true, false, false);
    }
}