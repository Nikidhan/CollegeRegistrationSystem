USE project;

CREATE TABLE Student
( matricNo VARCHAR (255) NOT NULL PRIMARY KEY,
  email VARCHAR (255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  icNum VARCHAR (255) NOT NULL,
  fullname VARCHAR (255) NOT NULL,
  gender VARCHAR(255) NOT NULL,
  race VARCHAR (255) NOT NULL,
  birthdate DATE NOT NULL,
  address VARCHAR(255) NOT NULL,
  programme VARCHAR (255) NOT NULL,
  semester VARCHAR (255) NOT NULL,
  levelStudy VARCHAR(255) NOT NULL,
  disability VARCHAR (255) NOT NULL
  -- maritalStatus VARCHAR (255) NOT NULL,
  -- householdIncome VARCHAR(255) NOT NULL,
  -- dependantsNo VARCHAR (255) NOT NULL,
  -- bankName VARCHAR (255) NOT NULL,
  -- bankAccountNo VARCHAR(255) NOT NULL
);

CREATE TABLE collegeActivity
( jtkID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  jtk VARCHAR (255) NOT NULL,
  projectName VARCHAR (255) NOT NULL,
  activityName VARCHAR (255) NOT NULL,
  detail VARCHAR (255) NOT NULL,
  activityDate DATE NOT NULL,
  closeDate DATE NOT NULL,
  PRIMARY KEY (jtk,projectName,activityName)
);

CREATE TABLE activity
( projectID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  matricNo VARCHAR (255) NOT NULL,
  projectName VARCHAR (255) NOT NULL,
  projectActivity VARCHAR (255) NOT NULL,
  FOREIGN KEY (matricNo) REFERENCES student(matricNo)
);

CREATE TABLE Room
( roomID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  matricNo VARCHAR (255) NOT NULL,
  checkIn DATE NOT NULL,
  checkOut DATE NOT NULL,
  duration INT UNSIGNED NOT NULL,
  rental FLOAT(5,2) UNSIGNED NOT NULL,
  reason VARCHAR (255) NOT NULL,
  roomStatus VARCHAR (255) NOT NULL,
  roomNo VARCHAR (255) NOT NULL,
  FOREIGN KEY (matricNo) REFERENCES student(matricNo)
);

CREATE TABLE Food
( foodID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  matricNo VARCHAR (255) NOT NULL,
  foodName VARCHAR (255) NOT NULL,
  deliveryDate DATE NOT NULL,
  deliveryTime VARCHAR(255) NOT NULL,
  quantity VARCHAR (255) NOT NULL,
  totalPrice FLOAT(2) NOT NULL,
  foodStatus VARCHAR (255) NOT NULL,
  FOREIGN KEY (matricNo) REFERENCES student(matricNo)
);

CREATE TABLE Report
( ticketNo VARCHAR(255) NOT NULL PRIMARY KEY,
  matricNo VARCHAR (255) NOT NULL,
  problemType VARCHAR(255) NOT NULL,
  problemDetails VARCHAR(255) NOT NULL,
  mobileNum VARCHAR(255) NOT NULL,
  problemLocation VARCHAR(255) NOT NULL,
  problemStatus VARCHAR(255) NOT NULL,
  ticketDate DATE NOT NULL,
  ticketTime TIME(0) NOT NULL,
  filePath VARCHAR(255) NOT NULL,
  FOREIGN KEY (matricNo) REFERENCES student(matricNo)
);


CREATE TABLE problemtype 
( typeName VARCHAR (255) NOT NULL PRIMARY KEY
);



