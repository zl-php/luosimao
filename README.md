### 螺丝帽短信发送

基于 [Luosimao](https://luosimao.com/) 平台实现的短信单发及群发的 composer 包

#### 如何使用？

```
# 安装依赖
composer require zuogechengxu/luosimao

# 发布资源 生成 sms.php 配置文件
php artisan vendor:publish --provider="Zl\Luosimao\LuosimaoServiceProvider"

# 在 sms.php 中配置 luosimao 的短信 api key
'api_key' => env('LUOSIMAO_KEY', '123456'),

# 控制器内使用 短信单发，群发和查询余额
use Zuogechengxu\Luosimao\Facades\Sms;

$res = Sms::send('13800138000', '验证码：123456【铁壳测试】');
$res = Sms::send_batch(['13800138000', '13800138001'], '验证码：123456【铁壳测试】');
$res = Sms::getRemaining();

```

#### end