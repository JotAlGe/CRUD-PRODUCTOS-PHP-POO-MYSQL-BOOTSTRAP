create table levels
(
    cod_lev     INTEGER               not null,
    desc_lev    VARCHAR(255)          not null,
    primary key (cod_lev)
);

create table categories
(
    cod_cat     INTEGER               not null,
    desc_cat    VARCHAR(250)          not null,
    primary key (cod_cat)
);

create table users
(
    cod_us      INTEGER               not null AUTO_INCREMENT,
    cod_lev     INTEGER               not null,
    name_us     VARCHAR(200)          not null,
    nick_us     VARCHAR(200)          not null,
    photo_us    LONG VARCHAR                  ,
    primary key (cod_us),
    foreign key  (cod_lev)
       references levels (cod_lev)
);

create table products
(
    cod_prod    INTEGER               not null AUTO_INCREMENT,
    cod_cat     INTEGER               not null,
    cod_us      INTEGER               not null,
    name_prod   VARCHAR(255)          not null,
    obs_prod    VARCHAR(255)          not null,
    photo_prod  LONG VARCHAR                  ,
    primary key (cod_prod),
    foreign key  (cod_cat)
       references categories (cod_cat),
    foreign key  (cod_us)
       references users (cod_us)
);

