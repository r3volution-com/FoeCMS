SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';
-- -;
-- User Account;
-- -;
DROP TABLE IF EXISTS `foe_account`;
CREATE TABLE IF NOT EXISTS `foe_account` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `username` VARCHAR(30) NOT NULL DEFAULT '',
  `pass_sha` VARCHAR(50) NOT NULL DEFAULT '',
  `email` VARCHAR(50) NOT NULL DEFAULT '',
  `level` INT(11) NOT NULL DEFAULT '0',
  `secret_ask` VARCHAR(100) NOT NULL,
  `secret_answer_sha` VARCHAR(100) NOT NULL DEFAULT '',
  `avatar` VARCHAR(500) NOT NULL,
  `reputation` INT(11) NOT NULL DEFAULT '0',
  `invitation` INT(11) NOT NULL DEFAULT '10',
  `visitor_number` INT(11) NOT NULL DEFAULT '0',
  `style_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `birth_date` DATE NOT NULL,
  `sex` TINYINT(1) NOT NULL,
  `website` VARCHAR(200) NOT NULL,
  `firm` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_foe_account_foe_style1` (`style_id` ASC),
  CONSTRAINT `fk_foe_account_foe_style1`
    FOREIGN KEY (`style_id`)
    REFERENCES `foe_style` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'Account System' 
ROW_FORMAT = DYNAMIC;
-- -;
-- Item Category;
-- -;
DROP TABLE IF EXISTS `foe_category`;
CREATE TABLE IF NOT EXISTS `foe_category` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
  `parent_category_id` INT(11) NOT NULL,
  `url` VARCHAR(50) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`category_id`))
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;
INSERT INTO `foe_category` (`category_id`, `parent_category_id`, `url`, `name`) VALUES
(1, 0, 'test', 'Test');
-- -;
-- Item;
-- -;
DROP TABLE IF EXISTS `foe_item`;
CREATE TABLE IF NOT EXISTS `foe_item` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `name` VARCHAR(40) NOT NULL DEFAULT '',
  `description` VARCHAR(5000) NOT NULL DEFAULT '',
  `url` VARCHAR(30) NOT NULL DEFAULT '',
  `category_id` INT(11) NOT NULL,
  `votes` INT(11) NOT NULL,
  `points` DOUBLE NOT NULL,
  `aportedby_id` INT(11) UNSIGNED NOT NULL,
  `times_downloaded` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_foe_item_foe_account1` (`aportedby_id` ASC),
  INDEX `fk_foe_item_foe_category1` (`category_id` ASC),
  CONSTRAINT `fk_foe_item_foe_account1`
    FOREIGN KEY (`aportedby_id`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_foe_item_foe_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `foe_category` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'Account System' 
ROW_FORMAT = DYNAMIC;
INSERT INTO `foe_item` (`id`, `name`, `description`, `url`, `category_id`, `votes`, `points`, `aportedby_id`, `times_downloaded`) VALUES 
('1', 'Test Item', 'A test for you', '', '1', '0', '0', '1', '0');
-- -;
-- Item comments;
-- -;
DROP TABLE IF EXISTS `foe_comment`;
CREATE TABLE IF NOT EXISTS `foe_comment` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `user_id` INT(11) UNSIGNED NOT NULL,
  `item_id` INT(11) UNSIGNED NOT NULL,
  `comment` VARCHAR(500) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_foe_comment_foe_account1` (`user_id` ASC),
  INDEX `fk_foe_comment_foe_item1` (`item_id` ASC),
  CONSTRAINT `fk_foe_comment_foe_account1`
    FOREIGN KEY (`user_id`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_foe_comment_foe_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `foe_item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'Account System' 
ROW_FORMAT = DYNAMIC;
INSERT INTO `foe_comment` (`id`, `user_id`, `item_id`, `comment`, `date`) VALUES 
(1, '1', '1', 'Comentario de prueba', CURRENT_TIMESTAMP);
-- -;
-- Cms Config;
-- -;
DROP TABLE IF EXISTS `foe_config`;
CREATE TABLE IF NOT EXISTS `foe_config` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `param` VARCHAR(50) NOT NULL,
  `value` VARCHAR(5000) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 30
DEFAULT CHARACTER SET = latin1;
INSERT INTO `foe_config` (`id`, `param`, `value`) VALUES
(1, 'name', 'FOECMS'),
(2, 'default_lang', '1'),
(3, 'default_style', '1'),
(4, 'contact_mail', 'prueba@prueba.com'),
(5, 'note_panel', ''),
(6, 'guest_access', '0'),
(7, 'guest_register', '1'),
(8, 'guest_register_without_inv', '1'),
(9, 'guest_comment', '0'),
(10, 'guest_download', '0'),
(11, 'guest_vote', '0'),
(12, 'guest_post', '0'),
(13, 'user_comment', '1'),
(14, 'user_download', '1'),
(15, 'user_vote', '1'),
(16, 'user_post', '1'),
(17, 'cookie_prefix', 'foecms'),
(18, 'php_root', '/'),
(19, 'mail_register', ''),
(20, 'mail_recpass', ''),
(21, 'mail_mp', ''),
(22, 'mail_invitation', ''),
(23, 'item_per_page', '10'),
(24, 'description', ''),
(25, 'keywords', ''),
(26, 'see_profile', '1'),
(27, 'see_friends', '1'),
(28, 'web_access', '1'),
(29, 'seo_url', '0'),
(30, 'web_access_text', '');
-- -;
-- User friends;
-- -;
DROP TABLE IF EXISTS `foe_friend`;
CREATE  TABLE IF NOT EXISTS `foe_friend` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `user_send` INT(11) UNSIGNED NOT NULL,
  `user_receive` INT(11) UNSIGNED NOT NULL,
  `alive` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `fk_foe_friend_foe_account1` (`user_send` ASC),
  INDEX `fk_foe_friend_foe_account2` (`user_receive` ASC),
  CONSTRAINT `fk_foe_friend_foe_account1`
    FOREIGN KEY (`user_send`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_foe_friend_foe_account2`
    FOREIGN KEY (`user_receive`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;
-- -;
-- Frontpage News;
-- -;
DROP TABLE IF EXISTS `foe_frontpage_news`;
CREATE  TABLE IF NOT EXISTS `foe_frontpage_news` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `author_id` INT(11) UNSIGNED NOT NULL,
  `text` VARCHAR(5000) NOT NULL DEFAULT '',
  `date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_foe_frontpage_news_foe_account1` (`author_id` ASC),
  CONSTRAINT `fk_foe_frontpage_news_foe_account1`
    FOREIGN KEY (`author_id`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'Account System' 
ROW_FORMAT = DYNAMIC;
INSERT INTO `foe_frontpage_news` (`id`, `author_id`, `text`, `date`) VALUES
(1, 1, 'Abrimos', '2012-01-28');
-- -;
-- User Invitation;
-- -;
DROP TABLE IF EXISTS `foe_invitation`;
CREATE  TABLE IF NOT EXISTS `foe_invitation` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `from_user` INT(11) UNSIGNED NOT NULL,
  `to_email` VARCHAR(100) NOT NULL,
  `inv_session` VARCHAR(100) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_foe_invitation_foe_account` (`from_user` ASC),
  CONSTRAINT `fk_foe_invitation_foe_account`
    FOREIGN KEY (`from_user`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;
DROP TABLE IF EXISTS `foe_lang`;
CREATE  TABLE IF NOT EXISTS `foe_lang` (
  `id` INT(100) NOT NULL AUTO_INCREMENT,
  `lang` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;
INSERT INTO `foe_lang` (`id`, `lang`) VALUES
(1, 'es'),
(2, 'en');
-- -;
-- User Mps;
-- -;
DROP TABLE IF EXISTS `foe_mp`;
CREATE  TABLE IF NOT EXISTS `foe_mp` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `idsend` INT(11) UNSIGNED NOT NULL,
  `idreceive` INT(11) UNSIGNED NOT NULL,
  `topic` VARCHAR(100) NOT NULL DEFAULT '',
  `message` VARCHAR(5000) NOT NULL DEFAULT '',
  `read` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_foe_mp_foe_account1` (`idsend` ASC),
  INDEX `fk_foe_mp_foe_account2` (`idreceive` ASC),
  CONSTRAINT `fk_foe_mp_foe_account1`
    FOREIGN KEY (`idsend`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_foe_mp_foe_account2`
    FOREIGN KEY (`idreceive`)
    REFERENCES `foe_account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'Account System' 
ROW_FORMAT = DYNAMIC;
-- -;
-- Reports Table;
-- -;
DROP TABLE IF EXISTS `foe_report`;
CREATE TABLE IF NOT EXISTS `foe_report` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  `text` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;
-- -;
-- Style Info;
-- -;
DROP TABLE IF EXISTS `foe_style`;
CREATE  TABLE IF NOT EXISTS `foe_style` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `name` VARCHAR(50) NOT NULL,
  `url` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'Account System' 
ROW_FORMAT = DYNAMIC;
INSERT INTO `foe_style` (`id`, `name`, `url`) VALUES
(1, 'Default', 'default');
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
