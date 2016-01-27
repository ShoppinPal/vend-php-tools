<?php
namespace Www\View\Layout;

use YapepBase\View\LayoutAbstract;

/**
 * Default layout
 */
class DefaultLayout extends LayoutAbstract {

    /**
     * Does the actual rendering.
     *
     * @return void
     */
    protected function renderContent()
    {
//-------------------- HTML ------------------ ?>
<html>
<head>
    <?php $this->renderTitle(); ?>
</head>
<body>
    <?php $this->renderInnerContent() ?>
</body>
</html>
<?php // ----------------------- /HTML --------------------------
    }

}
