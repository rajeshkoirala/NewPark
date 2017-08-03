
CREATE TABLE `km` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_key` varchar(255) DEFAULT NULL,
  `km_key` varchar(255) DEFAULT NULL,
  `km_value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insert_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
)