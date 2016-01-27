<?php

namespace VendTools\Dao\Table\Vend;

class UserTable extends \YapepBase\Database\MysqlTable
{

    /** Field: id */
    const FIELD_ID = 'id';

    /** The username for the user */
    const FIELD_USERNAME = 'username';

    /** The password hash for the user */
    const FIELD_PASSWORD = 'password';

    /** The email of the user */
    const FIELD_EMAIL = 'email';


    /**
     * The name of the table.
     *
     * @var string
     */
    protected $tableName = 'user';

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
            self::FIELD_USERNAME,
            self::FIELD_PASSWORD,
            self::FIELD_EMAIL,
        );
    }
}
