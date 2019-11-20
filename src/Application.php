<?php
namespace App;
use ESD\Core\Server\Config\ServerConfig;
use ESD\Go\GoApplication;
use ESD\Go\GoPort;
use ESD\Go\GoProcess;
use ESD\Server\Co\Server;
use ESD\Yii\PdoPlugin\PdoPlugin;
use ESD\Plugins\EasyRoute\Filter\FilterManager;
use ESD\Plugins\EasyRoute\Filter\CorsFilter;

class Application
{

    public function __construct(FilterManager $filterManager)
    {
        $filterManager->addFilter(new CorsFilter());
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws \ESD\Core\Exception
     * @throws \ESD\Core\Plugins\Config\ConfigException
     * @throws \ReflectionException
     */
    public static function main()
    {
//        GoApplication::runApp(Application::class);
        //如果要添加插件和切片使用下面的代码启动
        /* $goApp = new GoApplication();
         $goApp->addPlug(new EasyRoutePlugin());
         $goApp->addAspect(new RouteAspect());
         $goApp->run(Application::class);*/

        $goApp = new MyApplication();
        $goApp->addPlug(new PdoPlugin());
        $goApp->run(Application::class);
    }
}


class MyApplication extends GoApplication
{
    /**
     * Application constructor.
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function __construct()
    {
        $serviceConfig = new ServerConfig();
        $serviceConfig->setBanner("
         _   _                  _____ _________  ___
        | \ | |                /  __ \| ___ \  \/  |
        |  \| | __ _ _ __ _   _| /  \/| |_/ / .  . |
        | . ` |/ _` | '__| | | | |    |    /| |\/| |
        | |\  | (_| | |  | |_| | \__/\| |\ \| |  | |
        \_| \_/\__,_|_|   \__,_|\____/\_| \_\_|  |_/
        ");
        Server::__construct($serviceConfig, GoPort::class, GoProcess::class);
    }
}
