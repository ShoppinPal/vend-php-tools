<?php
namespace Www\View\Template;
use YapepBase\Helper\View\UrlHelper;

/**
 * Template for the main page
 */
class IndexIndexTemplate extends BaseTemplateAbstract
{
    /**
     * Does the actual rendering.
     *
     * @return void
     */
    protected function renderContent()
    {
        $urlHelper = new UrlHelper();
//-------------------- HTML ------------------ ?>
<h1>Welcome to Vend Tools</h1>
<p>Please <a href="<?= $urlHelper->getRouteTarget('Index', 'Login') ?>">log in</a>
    or <a href="<?= $urlHelper->getRouteTarget('Index', 'SignUp') ?>">sign up</a></p>
<?php // ----------------------- /HTML --------------------------
    }

}
