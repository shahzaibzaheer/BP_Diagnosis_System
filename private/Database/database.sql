
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


/** Create prescription table */
CREATE TABLE `bp_diagnosis_system`.`prescription_table` (
   `prescription_id` INT(11) NOT NULL ,
   `doctor_id` INT(11) NOT NULL ,
   `patient_id` INT(11) NOT NULL ,
   `status` VARCHAR(60) NOT NULL ,
   `subject` VARCHAR(255) NOT NULL ,
   `bp_low` INT(5) NOT NULL ,
   `bp_high` INT(5) NOT NULL ,
   `headache` BOOLEAN NOT NULL ,
   `dizziness` BOOLEAN NOT NULL ,
   `visual_changes` VARCHAR(255) NOT NULL ,
   `medication` VARCHAR(255) NOT NULL ,
   `food_detail` VARCHAR(255) NOT NULL ,
   `exercise_detail` VARCHAR(255) NOT NULL ,
   `other_info` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`prescription_id`)) ENGINE = InnoDB;
