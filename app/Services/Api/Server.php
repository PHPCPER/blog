<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2018/12/24
 * Time: 10:13
 */

namespace App\Services\Api;

use Illuminate\Http\Request;
use Validator;

class Server
{
    /**
     * 请求参数
     * @var array
     */
    protected $params = [];

    /**
     * API请求Method名
     * @var string
     */
    protected $method;

    /**
     * app_id
     * @var string
     */
    protected $app_id;

    /**
     * app_secret
     * @var string
     */
    protected $app_secret;

    /**
     * 回调数据格式
     * @var string
     */
    protected $format = 'json';

    /**
     * 签名方法
     * @var string
     */
    protected $sign_method = 'md5';

    /**
     * 是否输出错误码
     * @var boolean
     */
    protected $error_code_show = false;

    /**
     * 语言
     * @var string
     */
    protected $lang = 'zh-CN';

    /**
     * token
     * @var string
     */
    protected $token = '';

    /**
     * 平台
     * @var string
     */
    protected $os = '';

    /**
     * 初始化
     * @param Error $error Error对象
     */
    public function __construct(Error $error)
    {
        $this->params = Request::all();
        $this->error  = $error;
    }

    public function run()
    {
        // A.1 初步校验
        $rules    = [
            'app_id'      => 'required',
            'method'      => 'required',
            'format'      => 'in:,json',
            'sign_method' => 'in:,md5',
            'nonce'       => 'required|string|min:1|max:32|',
            'sign'        => 'required',
            'os'          => 'required|in:,ios,android,wap,xcx,wx,terminal,pc,erp',
            'lang'        => 'in:,zh-CN,en'

        ];
        $messages = [
            'app_id.required' => '-1001',
            'method.required' => '-1003',
            'format.in'       => '-1004',
            'sign_method.in'  => '-1005',
            'nonce.required'  => '-1010',
            'nonce.string'    => '-1011',
            'nonce.min'       => '-1012',
            'nonce.max'       => '-1012',
            'sign.required'   => '-1006',
            'os.required'     => '-1014',
            'os.in'           => '-1013',
            'lang.in'         => '-1015',
        ];

        //写入请求日志
        \Log::notice('params::::'.json_encode($this->params));
        $v = Validator::make($this->params, $rules, $messages);
        if ($v->fails()) {
            return $this->response(['status' => false, 'code' => $v->messages()->first()]);
        }

    }

    /**
     * 输出结果
     * @param array $result
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function response(array $result)
    {

        if (!array_key_exists('msg', $result) && array_key_exists('code', $result)) {
            $result['msg'] = $this->getError($result['code']);
        }
        if(!empty($result['msg']) && !empty($result['replace'])){
            $result['msg'] = str_replace('{***}', $result['replace'], $result['msg']);
        }

        if(isset($result['status']) && !$result['status'] && !empty($result['list']) && $result['list']){
            $response = $result['data'];
            $err_list = [];
            foreach($response as $v){
                if(!empty($v['replace'])){
                    $err_list[] = [
                        'id' => $v['id'],
                        'info' => str_replace('{***}', $v['replace'], $this->getError($v['code'])),
                    ];
                }else{
                    $err_list[] = [
                        'id' => $v['id'],
                        'info' => $this->getError($v['code']),
                    ];
                }
            }
            $result['data'] = ['err_list' => $err_list];
        }
        unset($result['list']);

        if ($this->format == 'json') {
            return response()->json($result);
        }else{
            return false;
        }

    }

    /**
     * 返回错误内容
     * @param  string $code 错误码
     * @return string
     */
    protected function getError($code)
    {
        return $this->error->getError($code, $this->error_code_show, $this->lang);
    }

}
