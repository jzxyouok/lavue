<?php

function failJson($message, $status)
{
    return response()->json(['msg' => $message, 'data' => ''], $status);
}

function successJson($data = '')
{
    return response()->json(['msg' => '', 'data' => $data], 200);
}

function getPage($page, $pageName = 'page')
{

    if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
        return $page;
    }

    $page = app('request')->get($pageName);

    if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
        return $page;
    }

    return 1;
}

function getPageSize($pageSize, $pageSizeName = 'page_size')
{
    if (filter_var($pageSize, FILTER_VALIDATE_INT) !== false && (int) $pageSize >= 1) {
        return $pageSize;
    }

    $pageSize = app('request')->get($pageSizeName);

    if (filter_var($pageSize, FILTER_VALIDATE_INT) !== false && (int) $pageSize >= 1) {
        return $pageSize;
    }

    return 15;
}

function getDomain()
{
    return Config::get('app.url');
}

function getUploadImgUrl($path)
{
    if (substr($path, 0, 1) != '/') {
        $path = '/' . $path;
    }
    return getDomain() . $path;
}