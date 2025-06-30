-- Job Portal Database Setup
-- Run this file in your MySQL database

-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
    `UserID` int(11) NOT NULL AUTO_INCREMENT,
    `Name` varchar(255) NOT NULL,
    `Email` varchar(255) NOT NULL UNIQUE,
    `Password` varchar(255) NOT NULL,
    `UserType` enum('employer','jobseeker','admin') NOT NULL,
    PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create employers table
CREATE TABLE IF NOT EXISTS `employers` (
    `EmployerID` int(11) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) NOT NULL,
    `CompanyName` varchar(255) NOT NULL,
    `VerifiedStatus` tinyint(1) DEFAULT 0,
    PRIMARY KEY (`EmployerID`),
    FOREIGN KEY (`UserID`) REFERENCES `users`(`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create jobseekers table
CREATE TABLE IF NOT EXISTS `jobseekers` (
    `JobseekerID` int(11) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) NOT NULL,
    `Resume` text,
    PRIMARY KEY (`JobseekerID`),
    FOREIGN KEY (`UserID`) REFERENCES `users`(`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create jobs table
CREATE TABLE IF NOT EXISTS `jobs` (
    `JobID` int(11) NOT NULL AUTO_INCREMENT,
    `EmployerID` int(11) NOT NULL,
    `Title` varchar(255) NOT NULL,
    `Description` text NOT NULL,
    `Requirements` text,
    `Salary` varchar(100),
    `Location` varchar(255),
    `Status` enum('active','inactive') DEFAULT 'active',
    PRIMARY KEY (`JobID`),
    FOREIGN KEY (`EmployerID`) REFERENCES `employers`(`EmployerID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create applications table
CREATE TABLE IF NOT EXISTS `applications` (
    `ApplicationID` int(11) NOT NULL AUTO_INCREMENT,
    `JobID` int(11) NOT NULL,
    `SeekerID` int(11) NOT NULL,
    `AppliedDate` datetime DEFAULT CURRENT_TIMESTAMP,
    `Status` enum('pending','reviewed','approved','rejected') DEFAULT 'pending',
    PRIMARY KEY (`ApplicationID`),
    FOREIGN KEY (`JobID`) REFERENCES `jobs`(`JobID`) ON DELETE CASCADE,
    FOREIGN KEY (`SeekerID`) REFERENCES `jobseekers`(`JobseekerID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create resumes table
CREATE TABLE IF NOT EXISTS `resumes` (
    `ResumeID` int(11) NOT NULL AUTO_INCREMENT,
    `JobseekerID` int(11) NOT NULL,
    `ResumeData` text NOT NULL,
    PRIMARY KEY (`ResumeID`),
    FOREIGN KEY (`JobseekerID`) REFERENCES `jobseekers`(`JobseekerID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample admin user
INSERT INTO `users` (`Name`, `Email`, `Password`, `UserType`) VALUES 
('Admin User', 'admin@jobportal.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample employer
INSERT INTO `users` (`Name`, `Email`, `Password`, `UserType`) VALUES 
('Test Employer', 'employer@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employer');

INSERT INTO `employers` (`UserID`, `CompanyName`, `VerifiedStatus`) VALUES 
(2, 'Test Company', 0);

-- Insert sample jobseeker
INSERT INTO `users` (`Name`, `Email`, `Password`, `UserType`) VALUES 
('Test Jobseeker', 'jobseeker@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jobseeker');

INSERT INTO `jobseekers` (`UserID`) VALUES (3);

-- Insert sample job
INSERT INTO `jobs` (`EmployerID`, `Title`, `Description`, `Requirements`, `Salary`, `Location`) VALUES 
(1, 'Software Developer', 'We are looking for a skilled software developer...', 'PHP, Laravel, MySQL', '$50,000 - $70,000', 'Remote');

-- Insert sample application
INSERT INTO `applications` (`JobID`, `SeekerID`, `Status`) VALUES 
(1, 1, 'pending'); 