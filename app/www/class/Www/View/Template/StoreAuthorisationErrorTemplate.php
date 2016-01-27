<?php
namespace Www\View\Template;

/**
 * Template for the store authorisation error page
 */
class StoreAuthorisationErrorTemplate extends BaseTemplateAbstract
{
    /**
     * @var string
     */
    protected $error;

    public function __construct($_error)
    {
        parent::__construct();

        $this->error = $this->get($_error);
    }

    /**
     * Does the actual rendering.
     *
     * @return void
     */
    protected function renderContent()
    {

//-------------------- HTML ------------------ ?>
        <h1>Store authorisation error</h1>
        <p>There was an error while authorising your store. Please try again later.</p>
        <?php if ($this->error): ?>
        <p>The error is: <?= $this->error ?>.</p>
        <?php endif; ?>
<?php // ----------------------- /HTML --------------------------
    }

}
