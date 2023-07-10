<?php

function outputJson($output)
{
    return response()->json([
        'message' => $output
    ], 200);
}