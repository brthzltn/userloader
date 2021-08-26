CREATE USER IF NOT EXISTS brth_userload_555_user@localhost identified by 'brth';
DROP SCHEMA IF EXISTS brth_userload_555;
CREATE SCHEMA IF NOT EXISTS brth_userload_555 DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE brth_userload_555;
create table loaded_users (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  age int,
  city varchar(100),
  country varchar(100),
  email varchar(100),
  salt varchar(100), 
  password varchar(64),
  picture varchar(200),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
GRANT ALL PRIVILEGES ON brth_userload_555.* to brth_userload_555_user@localhost WITH GRANT OPTION;
