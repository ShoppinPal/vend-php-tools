<?php
/**
 * @package    VendTools
 * @subpackage Dao\Table\Vend
 */

namespace VendTools\Dao\Table\Vend;

/**
 * Table class for the store table.
 *
 * @package    VendTools
 * @subpackage Dao\Table\Vend
 */
class StoreTable extends \YapepBase\Database\MysqlTable
{

    /** id field */
    const FIELD_ID = 'id';

    /** ID of the owner user */
    const FIELD_USER_ID = 'user_id';

    /** Domain prefix of the store at Vend */
    const FIELD_DOMAIN_PREFIX = 'domain_prefix';

    /** The current OAuth access token for the store at Vend */
    const FIELD_ACCESS_TOKEN = 'access_token';

    /** The token type for OAuth */
    const FIELD_TOKEN_TYPE = 'token_type';

    /** The expiration of the current OAuth access token */
    const FIELD_EXPIRES = 'expires';

    /** The OAuth refresh token */
    const FIELD_REFRESH_TOKEN = 'refresh_token';

    /** The time the store was created at */
    const FIELD_CREATED_AT = 'created_at';

    /**
     * The name of the table.
     *
     * @var string
     */
    protected $tableName = 'store';

    /**
     * Associative array containing all possible values for the enum fields.
     *
     * @var array
     */
    protected $enumValues = array();

    /**
     * The default connection name what will be used for the database connection.
     *
     * @var string
     */
    protected $defaultDbConnectionName = 'vend';

    /**
     * Returns the fields of the described table.
     *
     * @return array   The fields of the table.
     */
    public function getFields()
    {
        return array(
            self::FIELD_ID,
            self::FIELD_USER_ID,
            self::FIELD_DOMAIN_PREFIX,
            self::FIELD_ACCESS_TOKEN,
            self::FIELD_TOKEN_TYPE,
            self::FIELD_EXPIRES,
            self::FIELD_REFRESH_TOKEN,
            self::FIELD_CREATED_AT,
        );
    }
}
