<?php
namespace Www\View\Template;

use VendTools\Dao\Table\Vend\StoreTable;

/**
 * Template for the store list
 */
class StoreListTemplate extends BaseTemplateAbstract
{
    /**
     * @var array
     */
    protected $stores;

    /**
     * @var string
     */
    protected $connectUrl;

    public function __construct($_stores, $_connectUrl)
    {
        parent::__construct();

        $this->stores = $this->get($_stores);
        $this->connectUrl = $this->get($_connectUrl);
    }

    /**
     * Does the actual rendering.
     *
     * @return void
     */
    protected function renderContent()
    {

//-------------------- HTML ------------------ ?>
<h1>Vend tools</h1>
<?php if (!empty($this->stores)): ?>
<p>You have connected the following stores to vend tools:</p>
<table>
    <tr>
        <th>Domain prefix</th>
        <th>Added at</th>
    </tr>
    <?php foreach ($this->stores as $store): ?>
    <tr>
        <td><?= $store[StoreTable::FIELD_DOMAIN_PREFIX] ?></td>
        <td><?= $store[StoreTable::FIELD_CREATED_AT] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>You have no stores connected to vend tools</p>
<?php endif; ?>
<p><a href="<?= $this->connectUrl ?>">Connect a new store to vend tools</a></p>
<?php // ----------------------- /HTML --------------------------
    }

}
