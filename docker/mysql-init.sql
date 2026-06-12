-- Create second database and grant access
CREATE DATABASE IF NOT EXISTS `centrova_account` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON `centrova_account`.* TO 'centrova'@'%';
GRANT ALL PRIVILEGES ON `centrova`.* TO 'centrova'@'%';
FLUSH PRIVILEGES;
