<?php
namespace Www\View\Template;

use YapepBase\Helper\View\UrlHelper;

/**
 * Template for the store authorisation success page
 */
class StoreAuthorisationSuccessTemplate extends BaseTemplateAbstract
{
    /**
     * @var string
     */
    protected $domainPrefix;

    public function __construct($_domainPrefix)
    {
        parent::__construct();

        $this->domainPrefix = $this->get($_domainPrefix);
    }

    /**
     * Does the actual rendering.
     *
     * @return void
     */
    protected function renderContent()
    {

//-------------------- HTML ------------------ ?>
        <h1>Store authorised successfully</h1>
        <p>You have successfully added the store <b><?= $this->domainPrefix ?></b> to Vend tools</p>
        <p><a href="<?= (new UrlHelper())->getRouteTarget('Store', 'List') ?>">Back to the store list page</a> </p>
<?php // ----------------------- /HTML --------------------------
    }

}
