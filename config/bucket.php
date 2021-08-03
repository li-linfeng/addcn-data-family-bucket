<?php

$except_uri = [];
$need_record_uri = [];

return [
    'except_uri' => $except_uri,                  // 不需要记录的uri
    'except_pattern' => '',                    // 不需要積累的url的正則表達式
    'need_record_uri' => $need_record_uri,    // 不需要積累的url的正則表達式
    'need_record_pattern' => '',             // 不需要積累的url的正則表達式
    'imei' => ''                            //  header中记录 imei 的字段
];
