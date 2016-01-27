<?php
namespace Www\View\Template;

use Www\View\Layout\DefaultLayout;
use YapepBase\View\TemplateAbstract;

/**
 * Template for the main page
 */
abstract class BaseTemplateAbstract extends TemplateAbstract
{

    /**
     * BaseTemplateAbstract constructor.
     */
    public function __construct()
    {
        $this->setLayout(new DefaultLayout());
    }

}
