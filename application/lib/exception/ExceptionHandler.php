<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/3
 * Time: 下午5:14
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{

    private $code;
    private $msg;
    private $errorCode;

    public function render( \Exception $e)
    {
        if ($e instanceof BaseException)
        {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            if (config('app_debug')){
                return parent::render($e);
            }else{
                $this->code = 500;
                $this->msg = '服务器错误';
                $this->errorCode = 999;

                $this->recordErrorLog($e);
            }

        }
        $request = Request::instance();
        $url = $request->url();
        $err = [
            'msg'=>$this->msg,
            'errorCode'=>$this->errorCode,
            'request_url'=>$url,
        ];

        return json($err,$this->code);

    }

    public function recordErrorLog( \Exception $e)
    {
        Log::init([
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record([
            'msg'=>$e->getMessage(),
            'line'=>$e->getFile().' '.$e->getLine()
        ],'error');
    }
}













