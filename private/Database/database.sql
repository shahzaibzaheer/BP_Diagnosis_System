
/**** Create Patient Table */
CREATE TABLE `BP_Diagnosis_System`.`patients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(255) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `gender` BOOLEAN NOT NULL DEFAULT TRUE ,
  `hashedPassword` VARCHAR(255) NOT NULL ,
  `phone` VARCHAR(255) NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  `city` VARCHAR(255) NOT NULL ,
  `dob` TIMESTAMP NOT NULL ,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;
