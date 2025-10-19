CREATE TABLE `school_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `school_settings` (`setting_key`, `setting_value`) VALUES
('school_name', 'EduPay Nexus Academy'),
('school_email', 'contact@edupaynexus.com'),
('school_phone', '+1 (555) 123-4567'),
('school_address', '123 Education Lane, Knowledge City, 12345');
