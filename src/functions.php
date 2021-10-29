<?php
/**
 * 自定义的公共函数
 * @author   Sam <shanbumin@qq.com>
 * @date     2018-05-17 22:10:18
 *
 */

if (!function_exists('p')) {
    /**
     * print_r的调试输出,不停止继续执行
     * @return void
     * @author Sam <shanbumin@qq.com>
     */
    function p()
    {
        $arr = func_get_args();
        foreach ($arr as $_arr) {
            echo "<pre>";
            print_r($_arr);
            echo "</pre>";
        }
    }
}

if (!function_exists('shuffle_string')) {

    /**
     * 获取随机字符串
     * @param int $length
     * @return boolean
     */
    function shuffle_string($length = 10)
    {
        if ($length > 62)
            return false;
        $str = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        str_shuffle($str);
        return substr(str_shuffle($str), 26, $length);
    }

}


if (!function_exists('pd')) {
    /**
     * print_r的调试输出,停止程序继续执行
     * @param array $arr
     * @return void
     * @author Sam <shanbumin@qq.com>
     */
    function pd(...$arr)
    {
//        $arr = func_get_args();
        foreach ($arr as $_arr) {
            echo "<pre>";
            print_r($_arr);
            echo "</pre>";
        }
        die(1);
    }
}

if (!function_exists('d')) {
    /**
     * var_dump的调试输出,不停止程序继续执行
     * @param array $arr
     * @return void
     * @author Sam <shanbumin@qq.com>
     */
    function d(...$arr)
    {
//        $arr = func_get_args();
        foreach ($arr as $_arr) {
            echo "<pre>";
            var_dump($_arr);
            echo "</pre>";
        }
    }
}


if (!function_exists('obj2array')) {
    /**
     * 标准对象转换成数组(不支持复杂的对象以及层级深的对象)
     * @param $obj
     * @return array|mixed
     * @author @author Sam <shanbumin@qq.com>
     */
    function obj2array($obj)
    {
        if (empty($obj)) return [];
        return json_decode(json_encode($obj), true);
    }
}


if (!function_exists('memory_get_peak_usage_format')) {

    /**
     * 获取脚本内存峰值使用量
     * @return string
     * @author   Sam   <shanbumin@qq.com>
     */
    function memory_get_peak_usage_format()
    {
        $memory = (!function_exists('memory_get_peak_usage')) ? '0' : round(memory_get_peak_usage() / 1024 / 1024, 2) . 'MB';
        return $memory;

    }

}


if (!function_exists('get_success_api_response')) {
    /**
     * 仅仅针对成功的返回
     * @param array $data 返回的数据
     * @param array $input 前端传递的以及服务器端后续追加的数据
     * @return array
     * $author    Sam   <shanbumin@qq.com>
     * @receiver jt <mreden@163.com>
     */
    function get_success_api_response($data = [], $input = [])
    {
        //原始响应数据

        $response = ['message' => 'OK', 'status_code' => 200, 'data' => []];//固定返回格式
        //主要数据 这个边是empty方法时当data数据为0时就返回空数组,显然这个不是我们想要的 所以直接赋值就可以了 增加$data==0 为空值  所以需要单独判断
        if (!empty($data) || $data == 0) $response['data'] = $data;
        //额外追加数据
        $meta = [];
        //追加分页数据
        if (!empty($input['page_no'])) {
            $items = [
                'page_size' => (int)$input['page_size'],
                'page_no' => (int)$input['page_no'],
                'total' => (int)$input['total'] ?? 0,
                'pages' => (int)$input['pages'] ?? 0,
            ];
            $pagination = ['pagination' => $items];
        }
        if (!empty($pagination)) $meta['meta'][] = $pagination;
        //Todo 后续可追加更多的拓展项
        //隐藏列 author:yyb
        if (isset($input['hide'])) $meta['hide'] = $input['hide'];

        return array_merge($response, $meta);

    }
}


if (!function_exists('is_json')) {
    /**
     * 判断某个字符串是否是json格式
     * @param $string
     * @return bool
     * @author Sam <shanbumin@qq.com>
     */
    function is_json($string)
    {
        try {
            $str = json_decode($string);
            if ($str === null) return false;
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

}


if (!function_exists('DRE')) {
    /**
     * 封装PHP内核抛出异常的全局函数
     * @param $message  string   异常消息内容
     * @param int $code string   异常代码
     * @throws Exception
     * @author        Sam  <shanbumin@qq.com>
     */
    function TE($message, $code = 0)
    {
        throw new \Exception($message, $code);
    }
}


if (!function_exists('lighter')) {
    /**
     * Ding异常
     * @param $message
     * @param null $errors
     * @param null $previous
     * @param array $headers
     * @param int $code
     */
    function lighter($message = null, $errors = null, $previous = null, $headers = [], $code = 0)
    {
        throw new \Dingo\Api\Exception\ResourceException($message, $errors, $previous, $headers, $code);
    }
}


if (!function_exists('deep_trim')) {
    /**
     * 过滤空格符号
     * @param array $element 参数数组元素
     * @return array|string
     * @author  Sam <shanbumin@qq.com>
     * @date    2018-08-30 18:01:52
     */
    function deep_trim($element)
    {
        if (is_string($element)) return trim($element);
        if (is_array($element)) {
            $element = array_map('deep_trim', $element);
        }
        return $element;
    }
}

if (!function_exists('jwt_cache_key')) {
    /**
     * 标识符
     * @param string $access_token jwt分发的access_token
     * @return string
     * @author  Sam   <shanbumin@qq.com>
     * @date    2018-09-04 15:23:21
     */
    function jwt_cache_key($access_token)
    {
        return 'jwt_' . md5($access_token);
    }
}


if (!function_exists('getIp')) {

    /**
     * 获取请求ip
     *
     * @return ip地址
     */
    function getIp()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    }

}


if (!function_exists('parse_search')) {
    /**
     * 解析接口传递的搜索参数
     * @param $search
     * @return array
     * @author  Sam <shanbumin@qq.com>
     * @date    2018-09-15 15:54:33
     */
    function parse_search($search)
    {
        $params = [];
        $split = explode(';', $search);
        $split = array_filter($split);
        foreach ($split as $v) {
            $s = explode(':', $v);
            if (!isset($s[0]) || !isset($s[1])) continue;
            $params[$s[0]] = $s[1];
        }
        return $params;
    }
}

if (!function_exists('updateBatch')) {

    function updateBatch($tableName = "", $multipleData = array())
    {

        if ($tableName && !empty($multipleData)) {

            // column or fields to update
            $updateColumn = array_keys($multipleData[0]);
            $referenceColumn = $updateColumn[0]; //e.g id
            unset($updateColumn[0]);
            $whereIn = "";

            $q = "UPDATE " . $tableName . " SET ";
            foreach ($updateColumn as $uColumn) {
                $q .= "`" . $uColumn . "` = CASE ";

                foreach ($multipleData as $data) {
                    $field = is_string($data[$referenceColumn]) ? "'{$data[$referenceColumn]}'" : $data[$referenceColumn];
                    $q .= "WHEN `" . $referenceColumn . "` = " . $field . " THEN '" . $data[$uColumn] . "' ";
                }
                $q .= "ELSE `" . $uColumn . "` END, ";
            }
            foreach ($multipleData as $data) {
                $whereIn .= "'" . $data[$referenceColumn] . "', ";
            }
            $q = rtrim($q, ", ") . " WHERE `" . $referenceColumn . "` IN (" . rtrim($whereIn, ', ') . ")";
            // Update
            $DB = new Illuminate\Support\Facades\DB();
            return $DB::update($DB::raw($q));
        } else {
            return false;
        }
    }
}

if (!function_exists('get_domain')) {
    /**
     * 取得当前的域名
     * @return string
     * @author  Sam <shanbumin@qq.com>
     * @date    2018-09-17 15:56:57
     */
    function get_domain()
    {
        /* 协议 */
        $protocol = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';

        /* 域名或IP地址 */
        if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
        } elseif (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        } else {
            /* 端口 */
            if (isset($_SERVER['SERVER_PORT'])) {
                $port = ':' . $_SERVER['SERVER_PORT'];

                if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol))
                    $port = '';
            } else {
                $port = '';
            }

            if (isset($_SERVER['SERVER_NAME']))
                $host = $_SERVER['SERVER_NAME'] . $port;
            elseif (isset($_SERVER['SERVER_ADDR']))
                $host = $_SERVER['SERVER_ADDR'] . $port;
        }

        return $protocol . $host;
    }
}

if (!function_exists('changeInt')) {
    /**
     * @notes
     * @param $v
     * @return int
     * @author JTao <mreden@163.com>
     * @date 2019/4/12 16:20
     */
    function changeInt($v)
    {
        return (int)$v;
    }
}
if (!function_exists('thousand')) {
    function thousand($v)
    {
        return round($v / 10000, 2);
    }
}
//获取url中 参数值
if (!function_exists('convertUrlQuery')) {
    function convertUrlQuery($query)
    {
        $queryParts = explode('&', $query);

        $params = array();

        foreach ($queryParts as $param) {

            $item = explode('=', $param);

            $params[$item[0]] = $item[1];

        }

        return $params;

    }
}
if (!function_exists('app_path')) {
    /**
     * Get the path to the application folder.
     *
     * @param string $path
     * @return string
     */
    function app_path($path = '')
    {
        return app()->path($path);
    }
}

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->getConfigurationPath($path);
    }
}

if (!function_exists("msectime")) {
    //返回当前的毫秒时间戳
    function msectime()
    {
        list($msec, $sec) = explode(" ", microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
}

if (!function_exists("msecdate")) {
    //返回当前的毫秒时间戳
    function msecdate()
    {
        return date("YmdHis") . substr(msectime(), -3);
    }
}

if (!function_exists("orderId")) {
    //返回当前的毫秒时间戳
    function orderId()
    {
        return msecdate() . rand(100, 999);
    }
}

/**
 * @author taoshaoye
 * 获取月初 月末  当天时间
 */
if (!function_exists("getMonth")) {
    function getMonth($date = null)
    {
        // 默认
        $date = $date ?? date("Y-m-d");
        $firstDay = date('Y-m-01', strtotime($date));
        $nowDay = date('Y-m-d', strtotime($date));
        $lastDay = date('Y-m-d', strtotime("$firstDay +1 month -1 day"));
        return array($firstDay, $nowDay, $lastDay);
    }
}


if (!function_exists("delSymbol")) {
    //去除字符串中的 多余符合提高准确率
    function delSymbol($str)
    {
        $symbolArr = array(
            '​', '“', '”', '"', '>', '<', ' ', ' ', '`', '·', '~', '!', '！', '@', '#', '$', '￥', '%', '^', '……',
            '&', '*', '(', ')', '（', '）', '-', '_', '——', '+', '=', '|', '\\', '[', ']',
            '【', '】', '{', '}', ';', '；', ':', '：', '\'', '"', '“', '”', ',', '，', '<', '>', '《', '》', '.', '。', '/', '、', '?', '？', '.', '…', PHP_EOL
        );
        return str_replace($symbolArr, '', $str);
    }
}


if (!function_exists("unique_multidim_array")) {
    // 二维数组去除重复
    function unique_multidim_array($array, $key)
    {
        $temp_array = [];
        $i = 0;
        $key_array = [];

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}

// 二维数组组合
if (!function_exists("combination")) {
    function combination(array $options)
    {
        $rows = [];

        foreach ($options as $option => $items) {
            if (count($rows) > 0) {
                // 2、将第一列作为模板
                $clone = $rows;

                // 3、置空当前列表，因为只有第一列的数据，组合是不完整的
                $rows = [];

                // 4、遍历当前列，追加到模板中，使模板中的组合变得完整
                foreach ($items as $item) {
                    $tmp = $clone;
                    foreach ($tmp as $index => $value) {
                        $value[$option] = $item;
                        $tmp[$index] = $value;
                    }

                    // 5、将完整的组合拼回原列表中
                    $rows = array_merge($rows, $tmp);
                }
            } else {
                // 1、先计算出第一列
                foreach ($items as $item) {
                    $rows[][$option] = $item;
                }
            }
        }

        return $rows;
    }
}
















