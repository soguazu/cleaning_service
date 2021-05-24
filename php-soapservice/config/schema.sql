


CREATE TABLE `companies` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) UNIQUE,
  `email` varchar(255) UNIQUE,
  `logo_url` varchar(255),
  `address` varchar(255),
  `country` varchar(255),
  `tax_rate` float
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255),
  `avatar_url` varchar(255),
  `email` varchar(255) UNIQUE,
  `role` ENUM ('ADMIN', 'EMPLOYEE', 'CUSTOMER')
);

CREATE TABLE `customers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL UNIQUE,
  `name` varchar(255),
  `address` varchar(255),
  `phone` varchar(255)
);


CREATE TABLE `employees` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `company_id` int NOT NULL UNIQUE,
  `user_id` int NOT NULL UNIQUE,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `hourly_rate` float8
);

CREATE TABLE `holidays` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `company_id` int NOT NULL,
  `employee_id` int NOT NULL COMMENT 'An employee_id of 0 means all employees',
  `start_date` timestamp DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp DEFAULT CURRENT_TIMESTAMP,
  `approved` boolean DEFAULT false
);

CREATE TABLE `service_categories` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) UNIQUE
);

CREATE TABLE `services` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `service_category_id` int NOT NULL,
  `company_id` int NOT NULL,
  `name` varchar(255) UNIQUE
);

CREATE TABLE `service_rates` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `service_id` int NOT NULL,
  `unit` float,
  `amount` float,
  `duration` float,
  `supply_markup` float,
  `overhead_markup` float,
  `misc_markup` float
);

CREATE TABLE `service_requests` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `service_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `proposed_start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proposed_end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actual_start_date` timestamp NULL,
  `actual_end_date` timestamp NULL,
  `title` varchar(255),
  `status` text,
  `adjustment` float,
  `total` float,
  `unit` varchar(255)
);

CREATE TABLE `work_orders` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `created_at` timestamp,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `service_request_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `status` boolean
);

ALTER TABLE `employees` ADD FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

ALTER TABLE `employees` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `holidays` ADD FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

ALTER TABLE `holidays` ADD FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

ALTER TABLE `customers` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `services` ADD FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` 
(`id`);

ALTER TABLE `services` ADD FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

ALTER TABLE `service_rates` ADD FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

ALTER TABLE `service_requests` ADD FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

ALTER TABLE `service_requests` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `work_orders` ADD FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` 
(`id`);

ALTER TABLE `work_orders` ADD FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);
