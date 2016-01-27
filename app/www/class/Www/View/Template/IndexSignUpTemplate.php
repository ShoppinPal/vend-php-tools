<?php
namespace Www\View\Template;

use YapepBase\Helper\View\UrlHelper;

/**
 * Template for the main page
 */
class IndexSignUpTemplate extends BaseTemplateAbstract
{

    /**
     * @var array
     */
    protected $errors;

    public function __construct($_errors)
    {
        parent::__construct();

        $this->errors = $this->get($_errors);
    }

    /**
     * Does the actual rendering.
     *
     * @return void
     */
    protected function renderContent()
    {
        $urlHelper = new UrlHelper();
//-------------------- HTML ------------------ ?>
        <h1>Vend Tools signup</h1>
        <?php if (empty($this->errors)): ?>
        <div class="error">
            <?= implode('<br />', $this->errors) ?>
        </div>
        <?php endif; ?>
        <form method="post" action="<? $urlHelper->getRouteTarget('Index', 'SignUp') ?>">
            <label for="input_username">Username</label>
            <input type="text" id="input_username" name="username" /><br />
            <label for="input_password">Password</label>
            <input type="password" id="input_password" name="password" /><br />
            <label for="input_password2">Confirm password</label>
            <input type="password" id="input_password2" name="password2" /><br />
            <label for="input_email">E-mail</label>
            <input type="email" id="input_email" name="email" /><br />
            <input type="submit" value="Sign up" name="submit" />
        </form>
<?php // ----------------------- /HTML --------------------------
    }

}
