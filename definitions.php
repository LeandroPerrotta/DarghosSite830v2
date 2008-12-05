<?
define('CITY_QUENDOR', 1);
define('CITY_ARACURA', 2);
define('CITY_ROOKGAARD', 3);
define('CITY_THORN', 4);
define('CITY_SALAZART', 5);
define('CITY_NORTHREND', 6);

define('DIR_NORTH', 0);
define('DIR_WEST', 1);
define('DIR_SOUTH', 2);
define('DIR_EAST', 3);

define('SEX_FEMALE', 0);
define('SEX_MALE', 1);

define('VOC_NOVOC', 0);
define('VOC_SORCERER', 1);
define('VOC_DRUID', 2);
define('VOC_PALADIN', 3);
define('VOC_KNIGHT', 3);

define('SLOT_HEAD', 1);
define('SLOT_BACKPACK', 3);
define('SLOT_ARMOR', 4);
define('SLOT_RIGHTHAND', 5);
define('SLOT_LEFTHAND', 6);
define('SLOT_LEGS', 7);
define('SLOT_FEET', 8);
define('SLOT_AMMO', 10);

define('WORLD_TENERIAN', 0);
define('WORLD_UNITERIAN', 1);
define('WORLD_NORTHERIAN', 2);

define('ACCESS_ADMIN', 1);
define('ACCESS_SADMIN', 2);

define('PGT_MET_PAGSEGURO', 0);
define('PGT_MET_PAYPAL', 1);

define('PGT_TIP_BOLETO', 0);
define('PGT_TIP_ONLINE', 1);

define('PGT_COIN_BR', 0);
define('PGT_COIN_US', 1);

define('USE_QUESTION_TRIES', '3');

define('PGT_STAT_TOACCEPT', 0);
define('PGT_STAT_ACTIVED', 1);
define('PGT_STAT_EXPIRED', 2);
define('PGT_STAT_REJECTED', 3);

define('CHANGE_EMAIL_DAYS', 15);
define('CHANGE_EMAIL_TIMER', 60 * 60 * 24 * CHANGE_EMAIL_DAYS);

define('DELETE_CHAR_DAYS', 15);
define('DELETE_CHAR_TIMER', 60 * 60 * 24 * DELETE_CHAR_DAYS);

define('PAGE_ABOUT', 1);
define('PAGE_CONTACT', 2);
define('PAGE_DOWNLOADS', 3);

define('GUILD_IMAGES_DIR', 'guildimages/'); // Diret�rio padr�o da imagem de guild, partindo da raiz
define('GUILD_IMAGE_MAX_WIDTH', 300); // Largura m�xima permitida para uma imagem de guild
define('GUILD_IMAGE_MAX_HEIGHT', 300); // Altura m�xima permitida para uma imagem de guild
define('GUILD_IMAGE_IDEAL_WIDTH', 64); // Largura da imagem de guild no site
define('GUILD_IMAGE_IDEAL_HEIGHT', 64); // Altura da imagem de guild no site
define('GUILD_DEFAULT_NOIMG', 'guildimages/no.gif'); // Imagem padr�o para uma guild sem imagem
define('GUILD_MIN_LEVEL', 25); // Level minimo do char para poder criar uma guild?
define('GUILD_ONLY_PREMIUM', 1); // Apenas premium pode criar guilds?
?>