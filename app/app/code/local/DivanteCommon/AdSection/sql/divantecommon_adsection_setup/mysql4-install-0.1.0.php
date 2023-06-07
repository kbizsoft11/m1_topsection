<?php
/**
 * Created by JetBrains PhpStorm.
 * @copyright  Copyright (c) by Divante
 * @author     Adrian Badowski <abadowski@divante.pl>
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

// Create TopSection table
$installer->run("
    -- DROP TABLE IF EXISTS {$this->getTable('kbizsoft_topsection')};
   CREATE TABLE `kbizsoft_topsection` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `hyperlink` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `background_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

$installer->endSetup();