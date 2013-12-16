CREATE TABLE `users` (
	`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`username` varchar(255) NOT NULL UNIQUE,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`email_address` varchar(255) NOT NULL,
	`password` varchar(40) NOT NULL,
	`group_id` int unsigned NOT NULL,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

CREATE TABLE `groups` (
	`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`name` varchar(100) NOT NULL,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

INSERT INTO `groups` (`group_name`,`description`) VALUES 
('sysadmin', 'Global Super user, all permissions'),
('sta', 'Sales Tool Administrator, CRUD users, devices, responses, questions, products, states, languages'),
('inactive','Has no permissions to system');

CREATE TABLE `login_entries` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`user_id` int unsigned NOT NULL,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

CREATE TABLE `languages` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`short_name` varchar(2) NOT NULL,
	`long_name` varchar(100) NOT NULL,
	`user_id` int unsigned NOT NULL Default 1,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

INSERT INTO `languages` (`short_name`, `long_name`) VALUES
('en', 'English'),
('es', 'Spanish');

CREATE TABLE `states` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`abbreviation` varchar(2) NOT NULL,
	`full_name` varchar(100) NOT NULL,
	`footprint` int unsigned NOT NULL Default 0,
	`user_id` int unsigned NOT NULL Default 1,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

INSERT INTO `states` (`abbreviation`, `full_name`, `footprint`) VALUES
('AZ', 'Arizona', 1),
('AL', 'Alabama', 0),
('AR', 'Arkansas', 0),
('AK', 'Alaska', 0),
('CA', 'California', 0),
('CO', 'Colorado', 1),
('CT', 'Connecticut', 0),
('DE', 'Delaware', 0),
('FL', 'Florida', 0),
('GA', 'Georgia', 1),
('HI', 'Hawaii', 0),
('ID', 'Idaho', 1),
('IL', 'Illinois', 1),
('IN', 'Indiana', 1),
('IA', 'Iowa', 1),
('KS', 'Kansas', 1),
('KY', 'Kentucky', 0),
('LA', 'Louisiana', 0),
('ME', 'Maine', 0),
('MD', 'Maryland', 0),
('MA', 'Massachusetts', 0),
('MI', 'Michigan', 0),
('MN', 'Minnesota', 1),
('MS', 'Mississippi', 0),
('MO', 'Missouri', 1),
('MT', 'Montana', 0),
('NE', 'Nebraska', 1),
('NV', 'Nevada', 1),
('NH', 'New Hampshire', 0),
('NJ', 'New Jersey', 0),
('NM', 'New Mexico', 0),
('NY', 'New York', 0),
('NC', 'North Carolina', 0),
('ND', 'North Dakota', 1),
('OH', 'Ohio', 1),
('OR', 'Oregon', 1),
('PA', 'Pennsylvania', 0),
('RI', 'Rhode Island', 0),
('SC', 'South Carolina', 0),
('SD', 'South Dakota', 1),
('TN', 'Tennessee', 0),
('TX', 'Texas', 0),
('UT', 'Utah', 1),
('VT', 'Vermont', 0),
('VA', 'Virginia', 0),
('WA', 'Washington', 1),
('WV', 'West Virginia', 0),
('WI', 'Wisconsin', 1),
('WY', 'Wyoming', 0),
('DC', 'Washington, D.C.', 0),
('PR', 'Puerto Rico', 0);

CREATE TABLE `device_types` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`device_type_name` varchar(15) NOT NULL,
	`description` varchar(255) NOT NULL,
	`user_id` int unsigned NOT NULL Default 1,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

CREATE TABLE `responses` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`response_text` varchar(255) NOT NULL,
	`user_id` int unsigned NOT NULL Default 1,
	`question_id` int unsigned NOT NULL,
	`active` int unsigned NOT NULL Default 0,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

CREATE TABLE `questions` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`question_text` varchar(255) NOT NULL,
	`user_id` int unsigned NOT NULL Default 1,
	`product_id` int unsigned NOT NULL,
	`answer_type_id` int unsigned NOT NULL Default 1,
	`active` int unsigned NOT NULL Default 0,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

CREATE TABLE `answer_types` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`common_name` varchar(100) NOT NULL,
	`type` varchar(15) NOT NULL,
	`description` varchar(255) NULL,
	`user_id` int unsigned NOT NULL Default 1,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

INSERT INTO `answer_types` (`common_name`, `type`, `description`) VALUES
('Drop Down', 'select', 'A select or drop down form'),
('Radio', 'radio', 'A collection of radio buttons, only one can be selected'),
('Text', 'text', 'Standard text field for short text'),
('Checkbox', 'checkbox', 'Checkbox, allowing multiple choices'),
('Text Box', 'textarea', 'Longer format text area'),
('Phone Number', 'tel', 'HTML5 only! input type telphone, browser validation'),
('Date', 'date', 'HTML5 only! Date input, browser validation'),
('Date + Time', 'datetime', 'HTML5 Only! Date and Time input, browser validation'),
('Email', 'email', 'HTML5 Only! Email input, browser validation');

CREATE TABLE `products` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`short_name` varchar(15) NOT NULL,
	`long_name` varchar(100) NOT NULL,
	`description` varchar(255) NULL,
	`brochure_link` varchar(255) NULL,
	`user_id` int unsigned NOT NULL Default 1,
	
	`active` int unsigned NOT NULL Default 0,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
) CHARSET=utf8;

CREATE TABLE `prospect_products` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`product_id` int unsigned NOT NULL,
	`prospect_id` int unsigned NOT NULL,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
);

CREATE TABLE `prospect_responses` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`response_value` text NOT NULL,
	`prospect_id` int unsigned NOT NULL,
	`question_id` int unsigned NOT NULL,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
);

CREATE TABLE `origin_types` (	
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`short_name` varchar(15) NOT NULL,
	`description` varchar(255) NULL,
	`user_id` int unsigned NOT NULL Default 1,
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
);

CREATE TABLE `prospects` (
	`id` int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`email_address` varchar(255) NOT NULL,
	`address` varchar(255) NULL,
	`city` varchar(255) NULL,
	`state_id` int unsigned NULL,
	`zipcode` varchar(5) NULL,
	`phone_number` varchar(10) NULL,
	`email_optin-in` int unsigned NOT NULL Default 0,
	`language_id` int unsigned NOT NULL Default 1,
	`origin_type_id` int unsigned NOT NULL Default 1,
	`device_type_id` int unsigned NOT NULL Default 1,
	`agent_facebook_id` varchar(255),
	`global_nick` varchar(255),
	`agent_email_address` varchar(255),
	`created`  DATETIME NULL,
	`modified`  DATETIME NULL
);



