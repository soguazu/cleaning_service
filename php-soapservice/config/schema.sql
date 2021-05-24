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
