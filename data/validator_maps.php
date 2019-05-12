<?php

return [
    'accepted'  =>  '验证字段必须是 yes， on， 1，或 true。这在确认「服务条款」是否同意时相当有用',
    'active_url' =>  '根据 PHP 函数 dns_get_record，验证字段必须具有有效的 A 或 AAAA 记录',
    'after:date' =>  '验证字段必须是给定日期之后的值。日期值将传递到 PHP 函数 strtotime',
    'after_or_equal:date' =>  '验证字段必须是在给定日期之后或与此日期相同的值',
    'alpha' =>  '验证字段必须完全由字母构成',
    'alpha_dash' =>  '验证字段可能包含字母、数字，以及破折号 (-) 和下划线 ( _ )',
    'alpha_num' =>  '验证字段必须是完全是字母、数字',
    'array' =>  '验证的字段必须是一个 PHP 数组',
    'bail' =>  '在第一次验证失败后停止运行验证规则',
    'before:date' =>  '验证字段必须是在给定日期之前',
    'before_or_equal:date' => '验证字段必须是在给定日期之前或与之相同的日期',
    'between:min,max'   =>  '验证字段的大小必须在给定的 min 和 max 之间',
    'boolean' =>  '验证的字段必须可以转换为 Boolean 类型',
    'confirmed' =>  '验证字段必须具有匹配字段 foo_confirmation',
    'date' => '验证字段必须是有效的日期',
    'date_equals:date' => '验证字段必须等于给定日期',
    'date_format:format' => '验证字段必须匹配给定的日期格式',
    'different:field' => '验证字段必须具有与 field 不同的值',
    'digits:value' => '验证字段必须为 numeric ，且必须具有_value_的确切长度',
    'digits_between:min,max' => '验证的字段的长度必须在给定的 min 和 max 之间',
    'dimensions' => '验证中的文件必须是图片，并且符合指定的规则约束',
    'distinct' => '当验证数组时，验证字段不得包含任何重复值',
    'email' => '验证字段必须为正确格式的电子邮件地址',
    'exists:table,column' => '验证字段必须存在于给定的数据库表中',
    'file' => '验证的字段必须是成功上传的文件',
    'filled' => '验证字段存在时不得为空',
    'gt:field' => '验证字段必须大于给定的 field',
    'gte:field' => '验证字段必须大于或等于给定的 field',
    'image' => '验证的文件必须是图片 (jpeg, png, bmp, gif, 或 svg)',
    'in:...' => '验证字段必须包含在给定的值列表中',
    'in_array:anotherfield' => '验证的字段必须存在于另一个字段 anotherfield 的值中',
    'integer' => '验证的字段必须是整数',
    'ip' => '验证的字段必须是 IP 地址',
    'ipv4' => '验证的字段必须是 IPv4 地址',
    'ipv6' => '验证的字段必须是 IPv6 地址',
    'json' => '验证的字段必须是有效的 JSON 字符串',
    'lt:field' => '验证中的字段必须小于给定的字段',
    'lte:field' => '验证中的字段必须小于或等于给定的字段',
    'max:value' => '验证中的字段必须小于或等于 value',
    'mimetypes:...' => '验证的文件必须与给定 MIME 类型之一匹配',
    'mimes:foo' => '验证的文件必须具有与列出的其中一个扩展名相对应的 MIME 类型',
    'min:value' => '验证中的字段必须具有最小值',
    'not_in:...' => '验证的字段不能包含在给定的值列表中',
    'not_regex:pattern' => '验证中的字段必须与给定的正则表达式不匹配',
    'nullable' => '验证的字段可以为 null',
    'numeric' => '验证的字段必须是数字',
    'present' => '验证的字段必须存在于输入数据中，但可以为空',
    'regex:pattern' => '验证的字段必须与给定的正则表达式匹配',
    'required' => '验证的字段必须存在于输入数据中，而不是空。',
    'required_if:anotherfield,...' => '如果 anotherfield 字段等于任一 value，验证的字段必须出现且不为空 ',
    'required_unless:anotherfield,...' => '如果 anotherfield 字段不等于任一 value，验证的字段必须出现且不为空',
    'required_with:...' => '只有在其他任一指定字段出现时，验证的字段才必须出现且不为空',
    'required_with_all:...' => '只有在其他指定字段全部出现时，验证的字段才必须出现且不为空',
    'required_without:...' => '只在其他指定任一字段不出现时，验证的字段才必须出现且不为空',
    'required_without_all:...' => '只有在其他指定字段全部不出现时，验证的字段才必须出现且不为空',
    'same:field' => '验证的字段必须与给定字段匹配',
    'size:value' => '验证的字段必须具有与给定值匹配的大小',
    'starts_with:...' => '验证的字段必须以给定值之一开头',
    'string' => '验证的字段必须是一个字符串',
    'timezone' => '验证的字段必须是一个基于 PHP 函数 timezone_identifiers_list 的有效时区标识',
    'unique:table,column,except,idColumn' => '验证的字段在给定的数据库表中必须是唯一的',
    'url' => '验证的字段必须是有效的 URL',
    'uuid' => '验证字段必须是有效的 RFC 4122（版本 1,3,4 或 5）通用唯一标识符（UUID）'
];