CREATE TABLE `banking_sparks`.`customers` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `email` VARCHAR(30) NOT NULL , `balance` DECIMAL NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `banking_sparks`.`transactions` (`id` INT NOT NULL AUTO_INCREMENT , `sender_id` INT NOT NULL , `receiver_id` INT NOT NULL , `amount` DECIMAL(10,2) NOT NULL , `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT INTO customers (name, email, balance)
VALUES 
    ('John Doe', 'john@example.com', 100.50),
    ('Jane Smith', 'jane@example.com', 250.75),
    ('Mark Johnson', 'mark@example.com', 500.00),
    ('Emily Davis', 'emily@example.com', 75.25),
    ('Michael Brown', 'michael@example.com', 300.00),
    ('Sarah Wilson', 'sarah@example.com', 50.00),
    ('David Thompson', 'david@example.com', 150.80),
    ('Jennifer Lee', 'jennifer@example.com', 400.50),
    ('Robert Miller', 'robert@example.com', 200.25),
    ('Lisa Taylor', 'lisa@example.com', 125.75);
