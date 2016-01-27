CREATE TABLE user (
    id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(50)  NOT NULL COMMENT 'Username of the user',
    password CHAR(60)     NOT NULL COMMENT 'Password hash of the user',
    email    VARCHAR(200) NOT NULL COMMENT 'Email of the user',
    PRIMARY KEY (id),
    UNIQUE KEY idx_username(username)
) ENGINE = InnoDB;

CREATE TABLE store (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id       INT UNSIGNED NOT NULL COMMENT 'ID of the owner user',
    domain_prefix VARCHAR(100) NOT NULL COMMENT 'Domain prefix of the store at Vend',
    access_token  VARCHAR(50)  NOT NULL COMMENT 'The current OAuth access token for the store at Vend',
    token_type    VARCHAR(20)  NOT NULL COMMENT 'The token type for OAuth',
    expires       INT UNSIGNED NOT NULL COMMENT 'The expiration of the current OAuth access token',
    refresh_token VARCHAR(50)  NOT NULL COMMENT 'The OAuth refresh token',
    created_at    DATETIME     NOT NULL COMMENT 'The time the store was created at',
    PRIMARY KEY (id),
    KEY idx_user_id_domain_prefix(user_id, domain_prefix),
    CONSTRAINT fk_store_user_id
    FOREIGN KEY (user_id)
        REFERENCES user(id)
) ENGINE = InnoDB;
