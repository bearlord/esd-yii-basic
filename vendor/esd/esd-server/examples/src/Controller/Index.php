<?php
namespace ESD\Examples\Controller;
use DI\Annotation\Inject;
use ESD\Plugins\Blade\Blade;
use ESD\Plugins\EasyRoute\Annotation\GetMapping;
use ESD\Plugins\EasyRoute\Annotation\RestController;

/**
 * @RestController()
 * Class Index
 * @package ESD\Plugins\EasyRoute
 */
class Index extends Base
{

    /**
     * @Inject()
     * @var Blade
     */
    protected $blade;
    /**
     * @GetMapping("/")
     * @return string
     */
    public function index()
    {
        return $this->blade->render("app::welcome");
    }
}