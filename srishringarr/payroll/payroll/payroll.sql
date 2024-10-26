# phpMyAdmin MySQL-Dump
# version 2.2.3-rc1
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost
# Generation Time: Feb 10, 2002 at 03:26 AM
# Server version: 3.22.32
# PHP Version: 4.0.5
# Database : newpay
# --------------------------------------------------------

#
# Table structure for table bonus
#

DROP TABLE IF EXISTS bonus;
CREATE TABLE bonus (
   bonusid int(10) NOT NULL auto_increment,
   empid int(10) NOT NULL,
   datebonus date  NOT NULL,
   bonuspayment varchar(200) NOT NULL,
   note text NOT NULL,
   PRIMARY KEY (bonusid)
);

#
# Dumping data for table bonus
#

# --------------------------------------------------------

#
# Table structure for table deductions
#

DROP TABLE IF EXISTS deductions;
CREATE TABLE deductions (
   deducid int(10)  NOT NULL auto_increment,
   empid int(10) NOT NULL,
   deductype varchar(200) NOT NULL,
   amount varchar(200) NOT NULL,
   note text NOT NULL,
   PRIMARY KEY (deducid)
);

#
# Dumping data for table deductions
#

# --------------------------------------------------------

#
# Table structure for table department
#

DROP TABLE IF EXISTS department;
CREATE TABLE department (
   deptid int(10)  NOT NULL auto_increment,
   managerid int(10)  NOT NULL,
   deptparentid int(10)  NOT NULL,
   deptname varchar(255) NOT NULL,
   location varchar(255) NOT NULL,
   deptdesc text NOT NULL,
   mandaworkdesc varchar(255) NOT NULL,
   messaging varchar(50) NOT NULL,
   PRIMARY KEY (deptid)
);

#
# Dumping data for table department
#

INSERT INTO department VALUES (1, 0, -1, 'Root Department', '', 'This is the head department', 'y', 'y');
# --------------------------------------------------------

#
# Table structure for table deptevents
#

DROP TABLE IF EXISTS deptevents;
CREATE TABLE deptevents (
   eventid int(10)  NOT NULL auto_increment,
   deptid int(10)  NOT NULL,
   eventdate date  NOT NULL,
   eventtime varchar(50) NOT NULL,
   eventbody text NOT NULL,
   postedby varchar(255) NOT NULL,
   dateposted date  NOT NULL,
   expirydate date  NOT NULL,
   active varchar(10) DEFAULT 'y' NOT NULL,
   PRIMARY KEY (eventid)
);

#
# Dumping data for table deptevents
#

# --------------------------------------------------------

#
# Table structure for table empcategory
#

DROP TABLE IF EXISTS empcategory;
CREATE TABLE empcategory (
   catid int(10)  NOT NULL auto_increment,
   catname varchar(255) NOT NULL,
   catdesc text NOT NULL,
   miscnote text NOT NULL,
   PRIMARY KEY (catid)
);

#
# Dumping data for table empcategory
#

INSERT INTO empcategory VALUES (1, 'Full Time', 'Full Time Worker', '');
INSERT INTO empcategory VALUES (2, 'Intern', 'Intern', '');
INSERT INTO empcategory VALUES (3, 'Part Time', 'Part Time', '');
# --------------------------------------------------------

#
# Table structure for table employee
#

DROP TABLE IF EXISTS employee;
CREATE TABLE employee (
   empid int(10)  NOT NULL auto_increment,
   deptid int(10)  NOT NULL,
   jobid int(10)  NOT NULL,
   parentid int(10)  NOT NULL,
   typeid varchar(50) NOT NULL,
   catid varchar(50) NOT NULL,
   salutation varchar(50) NOT NULL,
   lastname varchar(255) NOT NULL,
   firstname varchar(255) NOT NULL,
   minit varchar(15) NOT NULL,
   ssn varchar(50) NOT NULL,
   dob date  NOT NULL,
   gender varchar(15) NOT NULL,
   race varchar(50) NOT NULL,
   marital varchar(50) NOT NULL,
   address1 varchar(255) NOT NULL,
   address2 varchar(255) NOT NULL,
   city varchar(255) NOT NULL,
   state varchar(150) NOT NULL,
   zipcode varchar(100) NOT NULL,
   country varchar(200) NOT NULL,
   email varchar(255) NOT NULL,
   webpage varchar(255) NOT NULL,
   homephone varchar(100) NOT NULL,
   officephone varchar(100) NOT NULL,
   cellphone varchar(100) NOT NULL,
   regularhours varchar(50) NOT NULL,
   login varchar(100) NOT NULL,
   password varchar(100) NOT NULL,
   admin varchar(5)  NOT NULL,
   superadmin varchar(5) NOT NULL,
   numlogins int(10)  NOT NULL,
   datesignup date NOT NULL,
   ipsignup varchar(100) NOT NULL,
   lastlogindate datetime  NOT NULL,
   loginip varchar(100) NOT NULL,
   dateupdated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   ipupdated varchar(100) NOT NULL,
   lastproject int(10) DEFAULT '0' NOT NULL,
   active varchar(50) DEFAULT 'n' NOT NULL,
   PRIMARY KEY (empid)
);

#
# Dumping data for table employee
#

INSERT INTO employee VALUES (1, 1, 0, 0, '', '', '', 'Administrator', 'Administrator', '', '', '0000-00-00', '', 'other', 'single', '', '', '', '', '', '', 'admin@emailgpl.com', '', '', '', '', '', 'admin', 'eps', '1', '1', 4, '0000-00-00', '', '0000-00-00 00:00:00', '192.168.1.1', '0000-00-00 00:00:00', '', 0, 'y');
INSERT INTO employee VALUES (2, 1, 1, 1, '1', '3', 'Mr', 'GPL', 'Man', '', '999999999', '2001-12-01', 'm', 'oh', 'Single', 'Open Source Road,', '', 'GPL City', 'MS', '', '99999', 'gplman@email.com', '', '999-999-9999', '', '', '40', 'test', 'test', '0', '0', 3, '0000-00-00', '130.74.170.100', '0000-00-00 00:00:00', '192.168.1.1', '2001-12-03 22:48:32', '130.74.170.100', 1, 'y');
# --------------------------------------------------------

#
# Table structure for table employeetype
#

DROP TABLE IF EXISTS employeetype;
CREATE TABLE employeetype (
   typeid int(10)  NOT NULL auto_increment,
   typename varchar(255) NOT NULL,
   typedesc text NOT NULL,
   miscnote text NOT NULL,
   PRIMARY KEY (typeid)
);

#
# Dumping data for table employeetype
#

INSERT INTO employeetype VALUES (1, 'Hourly', 'Hourly Worker, gets paid by the hour', '');
INSERT INTO employeetype VALUES (2, 'Salary', 'Salary Worker, gets paid on basis of yearly base salary\r\n', '');
INSERT INTO employeetype VALUES (3, 'Contract', 'Contract Worker, gets paid on contract to contract basis', '');
# --------------------------------------------------------

#
# Table structure for table emppicture
#

DROP TABLE IF EXISTS emppicture;
CREATE TABLE emppicture (
   picid int(10)  NOT NULL auto_increment,
   linkid int(10) DEFAULT '0' NOT NULL,
   type varchar(50) NOT NULL,
   filename varchar(255) NOT NULL,
   filesize varchar(255) NOT NULL,
   filetype varchar(255) NOT NULL,
   picture longblob NOT NULL,
   PRIMARY KEY (picid)
);

#
# Dumping data for table emppicture
#

# --------------------------------------------------------

#
# Table structure for table holidays
#

DROP TABLE IF EXISTS holidays;
CREATE TABLE holidays (
   holid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   datehols date DEFAULT '0000-00-00' NOT NULL,
   payment varchar(200) NOT NULL,
   note text NOT NULL,
   PRIMARY KEY (holid)
);

#
# Dumping data for table holidays
#

# --------------------------------------------------------

#
# Table structure for table hourly
#

DROP TABLE IF EXISTS hourly;
CREATE TABLE hourly (
   hourid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   hourlyrate varchar(100) NOT NULL,
   note text NOT NULL,
   PRIMARY KEY (hourid)
);

#
# Dumping data for table hourly
#

# --------------------------------------------------------

#
# Table structure for table iptable
#

DROP TABLE IF EXISTS iptable;
CREATE TABLE iptable (
   ipid int(10)  NOT NULL auto_increment,
   type varchar(50) NOT NULL,
   linkid int(10) DEFAULT '0' NOT NULL,
   ipaddress varchar(255) NOT NULL,
   note text NOT NULL,
   PRIMARY KEY (ipid)
);

#
# Dumping data for table iptable
#

# --------------------------------------------------------

#
# Table structure for table jobtitle
#

DROP TABLE IF EXISTS jobtitle;
CREATE TABLE jobtitle (
   jobid int(10)  NOT NULL auto_increment,
   jobtitle varchar(255) NOT NULL,
   jobdesc text NOT NULL,
   PRIMARY KEY (jobid)
);

#
# Dumping data for table jobtitle
#

INSERT INTO jobtitle VALUES (1, 'Default Job', 'This is the default job. Delete this job and add real jobs.');
# --------------------------------------------------------

#
# Table structure for table locks
#

DROP TABLE IF EXISTS locks;
CREATE TABLE locks (
   lockid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   datelock date DEFAULT '0000-00-00' NOT NULL,
   reasonlock varchar(255) NOT NULL,
   lockedby varchar(255) NOT NULL,
   active varchar(5) DEFAULT 'y' NOT NULL,
   PRIMARY KEY (lockid)
);

#
# Dumping data for table locks
#

# --------------------------------------------------------

#
# Table structure for table messages
#

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
   lmid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   message text NOT NULL,
   postedby varchar(255) NOT NULL,
   dateposted datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   numviews int(10) DEFAULT '0' NOT NULL,
   active varchar(10) DEFAULT 'y' NOT NULL,
   PRIMARY KEY (lmid)
);

#
# Dumping data for table messages
#

# --------------------------------------------------------

#
# Table structure for table payroll
#

DROP TABLE IF EXISTS payroll;
CREATE TABLE payroll (
   payrollid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   payrolldate date DEFAULT '0000-00-00' NOT NULL,
   startdate date DEFAULT '0000-00-00' NOT NULL,
   enddate date DEFAULT '0000-00-00' NOT NULL,
   hoursworked varchar(200) NOT NULL,
   grosspay varchar(200) NOT NULL,
   deductions varchar(200) NOT NULL,
   additions varchar(200) NOT NULL,
   netpay varchar(200) NOT NULL,
   PRIMARY KEY (payrollid)
);

#
# Dumping data for table payroll
#

# --------------------------------------------------------

#
# Table structure for table project
#

DROP TABLE IF EXISTS project;
CREATE TABLE project (
   projectid int(10)  NOT NULL auto_increment,
   deptid int(10) DEFAULT '0' NOT NULL,
   projecttitle varchar(255) NOT NULL,
   projectdesc text NOT NULL,
   hoursworked double(16,4) DEFAULT '0.0000' NOT NULL,
   active varchar(5) DEFAULT 'y' NOT NULL,
   PRIMARY KEY (projectid)
);

#
# Dumping data for table project
#

INSERT INTO project VALUES (1, 1, 'Default Project for Root Dept', 'This is a default project. Please delete this project and add real projects.', '0.0000', 'y');
# --------------------------------------------------------

#
# Table structure for table salary
#

DROP TABLE IF EXISTS salary;
CREATE TABLE salary (
   salaryid int(10) NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   baseyear varchar(100) NOT NULL,
   note text NOT NULL,
   PRIMARY KEY (salaryid)
);

#
# Dumping data for table salary
#

# --------------------------------------------------------

#
# Table structure for table sickday
#

DROP TABLE IF EXISTS sickday;
CREATE TABLE sickday (
   sickid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   datesick date DEFAULT '0000-00-00' NOT NULL,
   payment varchar(255) NOT NULL,
   note varchar(255) NOT NULL,
   PRIMARY KEY (sickid)
);

#
# Dumping data for table sickday
#

# --------------------------------------------------------

#
# Table structure for table timesheet
#

DROP TABLE IF EXISTS timesheet;
CREATE TABLE timesheet (
   timeid int(10)  NOT NULL auto_increment,
   empid int(10) DEFAULT '0' NOT NULL,
   projectid int(10) DEFAULT '0' NOT NULL,
   checkin datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   checkout datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   rawtime varchar(100) NOT NULL,
   roundedtime varchar(100) NOT NULL,
   workdesc text NOT NULL,
   ipcheckin varchar(100) NOT NULL,
   ipcheckout varchar(100) NOT NULL,
   checked varchar(50) NOT NULL,
   PRIMARY KEY (timeid)
);

#
# Dumping data for table timesheet
#


    
