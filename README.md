This is a Image Manager that was created as a dashboard for portfolio sites. It was implemented for two live client sites. These sites were adapted from the same core code that allowed the clients to upload their pictures, manage the order of the pictures and login to their secure dashboard.

This repository will be a implementation of this library, to make it more extensible for flexibility and application in portfolio websites.

Currently, written in PHP, jQuery UI and CodeIgniter version 3.x 

Version 1.0 - updated to CodeIgniter 3.x from 2.x

Installation
1) Create database
2) Use the following SQL to create the necessary tables

#START SQL

CREATE TABLE photo_gallery (
	id int(11) NOT NULL AUTO_INCREMENT,
	thumb_src varchar(128) NOT NULL,
	orig_src varchar(128) NOT NULL,
	title varchar(128) NOT NULL,
	section text NOT NULL,
	position int(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS  `login_data` (
	username varchar(40) DEFAULT '0' NOT NULL,
	password varchar(45) DEFAULT '0' NOT NULL
);

INSERT INTO login_data (username,password)
VALUES  ('admin', MD5('1234'));

CREATE TABLE IF NOT EXISTS temporary_bin (
	id int(11) NOT NULL AUTO_INCREMENT,
	string_field varchar(128) DEFAULT '0' NOT NULL,
	string_field_two varchar(128) DEFAULT '0' NOT NULL,
	int_field int(10) DEFAULT '0' NOT NULL,
	int_field_two int(10) DEFAULT '0' NOT NULL,
	PRIMARY KEY (id)
); 

ALTER TABLE temporary_bin ADD (string_field_three varchar(128) DEFAULT '0' NOT NULL);

ALTER TABLE temporary_bin ADD (string_field_four varchar(128) DEFAULT '0' NOT NULL);

#END SQL 

3) edit the artist/application/config/database.php file with your database details

4) edit the artist/application/config/config.php and change the $config['base_url'] variable to the url of the installation

5) In the same file edit $config['sess_save_path'] to a absolute path to your sessions folder located in the applications directory and CHMOD so no one but the server administrator has access

6) Go to the index.php/admin_login to get the admin form and login with 'admin' '1234' and start adding images, each section of the site has a separate upload link where you can add and remove images and click and drag to change the order

Image Dimensions
Featured Thumbnails 90 x 178, Featured Large 628 x 359

All the rest
Square Thumbnails around 200x200 and Large images any size or dimensions

