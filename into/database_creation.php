<?php
/*
هعمل قاعده بيانات storedb
اول جدول معايا هو 
-------المستخدمين--------- app_users
user_id
username
password
email
phone
subscriptionDate
LastLOGINH
users_group

------------------------------app_users_profiles
يبقي هنا لازم احط برايميرى كاي
user_id   foreign key to id 
FIRSTNAME
lastname
address
dob
image

-------------------
normalization forms
------------------
-----------------
دايما قسم الجدوال الواحد الي جداول اخرى
يعني ايه 
هننقل مثلا التليفون انقله لجدول تاني


هحط فيه البيانات الاساسيه
الاسم الباسورد الاميل الاي دي امتي عمل لوج ان والصلاحيات

| app_users | CREATE TABLE `app_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `subscriptiondate` date NOT NULL,
  `lastlogin` datetime NOT NULL,
  `user_group` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |

==================
| app_users_profile | CREATE TABLE `app_users_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `app_users_profile_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `app_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |
============================

create table app_users_profile (
     id int unsigned primary key auto_increment,
     users_id int(11)  unsigned not null,
     firstname varchar(10) not null,
     lastname varchar(10) not null,
     address varchar(50),
     DOB date,
     image varchar(50),
     foreign key(users_id) references app_user(user_id)
);

MariaDB [storedb]> describe app_users;
+------------------+------------------+------+-----+---------+----------------+
| Field            | Type             | Null | Key | Default | Extra          |
+------------------+------------------+------+-----+---------+----------------+
| user_id          | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
| username         | varchar(60)      | NO   | UNI | NULL    |                |
| password         | char(60)         | NO   |     | NULL    |                |
| email            | varchar(60)      | NO   | UNI | NULL    |                |
| phonenumber      | varchar(15)      | YES  |     | NULL    |                |
| subscriptiondate | date             | NO   |     | NULL    |                |
| lastlogin        | datetime         | NO   |     | NULL    |                |
| privilege        | tinyint(1)       | NO   |     | NULL    |                |
+------------------+------------------+------+-----+---------+----------------+


MariaDB [storedb]> describe  app_users_profile;
+-----------+------------------+------+-----+---------+----------------+
| Field     | Type             | Null | Key | Default | Extra          |
+-----------+------------------+------+-----+---------+----------------+
| id        | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| users_id  | int(11) unsigned | NO   | MUL | NULL    |                |
| firstname | varchar(10)      | NO   |     | NULL    |                |
| lastname  | varchar(10)      | NO   |     | NULL    |                |
| address   | varchar(50)      | YES  |     | NULL    |                |
| DOB       | date             | YES  |     | NULL    |                |
| image     | varchar(50)      | YES  |     | NULL    |                |
+-----------+------------------+------+-----+---------+----------------+


================================
عايز اعمل جدول الصلاحيات
عشان احدد صلاحيات المستخدمين داخل قاعده البيانات
app_users_groups;
هحتاج
    groupid
    groupname


======================================

app_users_group_privileges
privilegeID
GROUPid
privilege

=============================
MariaDB [storedb]> create table app_users_group(
    -> group_id tinyint(1) not null primary key auto_increment,
    -> group_name varchar(20) not null
    -> );
Query OK, 0 rows affected (0.024 sec)
MariaDB [storedb]> describe  app_users_group;
+------------+-------------+------+-----+---------+----------------+
| Field      | Type        | Null | Key | Default | Extra          |
+------------+-------------+------+-----+---------+----------------+
| group_id   | tinyint(1)  | NO   | PRI | NULL    | auto_increment |
| group_name | varchar(20) | NO   |     | NULL    |                |

هغير اسم الصلاحيات الي usergroup
MariaDB [storedb]> alter table app_users change privilege group_id tinyint(1) not null;
Query OK, 0 rows affected (0.009 sec)
Records: 0  Duplicates: 0  Warnings: 0

MariaDB [storedb]> describe  app_users;
+------------------+------------------+------+-----+---------+----------------+
| Field            | Type             | Null | Key | Default | Extra          |
+------------------+------------------+------+-----+---------+----------------+
| user_id          | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
| username         | varchar(60)      | NO   | UNI | NULL    |                |
| password         | char(60)         | NO   |     | NULL    |                |
| email            | varchar(60)      | NO   | UNI | NULL    |                |
| phonenumber      | varchar(15)      | YES  |     | NULL    |                |
| subscriptiondate | date             | NO   |     | NULL    |                |
| lastlogin        | datetime         | NO   |     | NULL    |                |
| group_id         | tinyint(1)       | NO   |     | NULL    |                |
+------------------+------------------+------+-----+---------+----------------+
8 rows in set (0.016 sec)

MariaDB [storedb]>

====================
هربط group id
الي موجود ف حدول المستخدمين انه علي هئيه مفتاح ثانوي
هربطه بمفتاح رئيسي الي موجد ف 
app_users_group;

create table app_users_groups_privileges(
    privilege_id tinyint(3) not null unsigned primary key auto_increment,
   group_id tinyint(3) not null unsigned,
   privilege varchar(50) not null);
       foreign (group_id) references app_users_group(group_id);

 create table app_users_group_privilegs(
     privilege_id tinyint(3) not null primary key auto_increment,
    group_id tinyint(3) not null,
    privileges varchar(50) not null);

     alter table app_users_group_privilegs add foreign key (group_id) references app_users_group(group_id);

=========================
MariaDB [storedb]> show tables;
+----------------------------+
| Tables_in_storedb          |
+----------------------------+
| app_users                  |
| app_users_group            |
| app_users_group_privileges |
| app_users_profile          |
+----------------------------+
4 rows in set (0.001 sec)

MariaDB [storedb]> describe app_users_group_privileges;
+--------------+-------------+------+-----+---------+----------------+
| Field        | Type        | Null | Key | Default | Extra          |
+--------------+-------------+------+-----+---------+----------------+
| privilege_id | tinyint(3)  | NO   | PRI | NULL    | auto_increment |
| group_id     | tinyint(3)  | NO   | MUL | NULL    |                |
| privileges   | varchar(50) | NO   |     | NULL    |                |
+--------------+-------------+------+-----+---------+----------------+
3 rows in set (0.018 sec)     ;

نفتح 
 mysql benchmark
 
 ============== هعمل شويه تعديلات زي ايه؟
 هعمل جدول لمجموعات المستخدمين
 و الصلاحيات
 وجدول يربط بينهم علاقه many to many
 ليه
 لان المستخدم ممكن يكون ليه اكتر من صلاحيه
 والصلاحيه يكون ليها اكتر من مستخدم
 ==================
 كده العلاقات
 جدول ال app_user and app_users profile
 one to one

 جدول app_users and app_users_group 
 علاقه one to many 
 الجروب الواحد ممكن يبقي فيه اكتر من مستخدم
 نما المستخدم الواحد هيبقي متواجد في جروب واحد بس

 الجروب الواحده ممكن يبقي ليها اكتر من صلاحيه 
 الصلاحيات هتتحط ف جروب واحد
 =========
 هنشيل عمود column group_id
 ويبقي كده جدول الصلاحيات مش مربوط باي حاجه خالص
 ================
 دلوقتي محتاج ادي للمستخدم الواحد اكتر من صلاحيه
 عن طريق الجروب الي منتمي ليها
 يعني الجروب ممكن يبقي ليها اكتر من صلاحيه وبالتالي هو ليه اكتر من صلاحيه
 وهنا علاقه
 many to many


create table `app_users_group_privileges` (
      id tinyint(3) NOT NULL AUTO_INCREMENT primary key,
      group_id tinyint(1) unsigned NOT NULL,
      privilege_id` tinyint(3) NOT NULL,
      foreign key(group_id) references app_users_group(group_id),
      foreign key(privilege_id) references app_users_privileges(privilege_id);

      =====
==========================================================================================
 store 
 مش هعمل مخزن انما هعمل 
 جدولين جدول للاصناف وجدول المنتجات
       هتبقي علاقه one to many
       الصنف الكاتيجورى يعن ممكن يبقي تحتيه اكتر من منتج
       انما المنتج الواحد يتبع كاتيجورى واحد فقط


    ====== app_products_category  =========

        category_id
        category_name
        category_image
   ======== app_products_list =======
        produbct_id
        category_id
        product_name
        product_iamge
        prodcut_qty
        prodcut_price
        prodcut_barcode
| app_products_category | CREATE TABLE `app_products_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  `category_iamge` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |

        create table app_products_list(
    product_id int unsigned not null primary key auto_increment,
    category_id int unsigned not null,
    product_name varchar(30) not null,
    product_iamge varchar(30),
    foreign key (category_id) references app_products_category(category_id)
    );

====================customers===============
  محتاج الاسم
  العنوان
  الهاتف

   create table app_clients(
    client_id int unsigned not null primary key auto_increment,
    client_name varchar(40) not null,
    client_number varchar(40) not null,
    email varchar(50) not null,
    address varchar(50) not null
    );
========= suplliers =======
 نفس الكلينتس 

 =======================
 MariaDB [storedb]> show tables;
+----------------------------+
| Tables_in_storedb          |
+----------------------------+
| app_clients                |
| app_products_category      |
| app_products_list          |
| app_suppliers              |
| app_users                  |
| app_users_group            |
| app_users_group_privileges |
| app_users_privileges       |
| app_users_profile          |
+----------------------------+

المصروفات ===========================
 عامله زي المخزن هتنقسم الي قسمين
 MariaDB [storedb]> show tables;
+----------------------------+
| Tables_in_storedb          |
+----------------------------+
| app_clients                |
| app_expenses_categories    |
| app_products_category      |
| app_products_list          |
| app_suppliers              |
| app_users                  |
| app_users_group            |
| app_users_group_privileges |
| app_users_privileges       |
| app_users_profile          |
+----------------------------+
10 rows in set (0.000 sec)

MariaDB [storedb]> show create table  app_expenses_categories;
+-------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Table                   | Create Table

                                        |
+-------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| app_expenses_categories | CREATE TABLE `app_expenses_categories` (
  `expense_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(50) NOT NULL,
  `fiexed_payment` decimal(7,2) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |
+-------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.000 sec)

MariaDB [storedb]>

هعمل جدول app_expenses_daily_list
=========================
عايز اعمل جدول المعاملات اللي هي هتبقي 
 
 الفواتير

فيه جدول للمبيعات
وجدول للمشتريات


 =============================
فاتوره المشتريات هحتاج فيها ايه
رقم الفاتوره
رقم المورد
حاله الفاتوره يعني مدفوعه كليا ولا جزئيا
نوع الدفع كاش ولا شبكه ولا غيره
وقت عمل الفاتوره 
ملحوظه علي الفاتوره
خصم علي الفاتوره


طيب الحاجات دي او متعلقات الفاتوره هحطها ف جدول تاني
الفاتوره الواحده فيها كذا منتج 
one to many

الاصناف الي هشتريها
رقم الصنف
رقم المنتج
الكميه
السعر
رقم الفاتوره

المورد الي هشترى منه
السعر الاجمالي
الوقت للفاتوره
واسم العميل بتاعي وده هيجي منين
هربطه بجدول العملاء
والكاتيجورى هربطه بالمنتجات


علاقه المورد بالفاتوره
many  to one
علاقه الفاتوره بالمور
one to many
===================================

هعمل سند قبض
وسند صرف
=====================================

هعمل عمليات السداد

سندات صرف نقديه خاصه بفواتير المشتريات
سندات قبض خاصه بالمبيعات
هيبقي فيها
رقم السند
تاريخ الصرف
رقم الفاتوره
نوع السداد
المبلغ
المبلغ بالاحرف
الموظف اللي عمله
اسم البنك
رقم حساب
رقم الشيك
اسم المحول اليه

---------------------+
| app_purchase_invoices_receipt | CREATE TABLE `app_purchase_invoices_receipt` (
  `receip_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_amount` decimal(8,2) NOT NULL,
  `payment_literal` varchar(100) NOT NULL,
  `bankname` varchar(50) DEFAULT NULL,
  `bankacount_number` varchar(30) DEFAULT NULL,
  `checknumber` varchar(30) DEFAULT NULL,
  `transferd_to` varchar(50) DEFAULT NULL,
  `created` date NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`receip_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `app_purchase_invoices_receipt_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `app_purchase_invoices` (`invoice_id`),
  CONSTRAINT `app_purchase_invoices_receipt_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`users_jd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |
MariaDB [storedb]> describe app_purchase_invoices_receipt;
+-------------------+------------------+------+-----+---------+----------------+
| Field             | Type             | Null | Key | Default | Extra          |
+-------------------+------------------+------+-----+---------+----------------+
| receip_id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| invoice_id        | int(10) unsigned | NO   | MUL | NULL    |                |
| payment_type      | tinyint(1)       | NO   |     | NULL    |                |
| payment_amount    | decimal(8,2)     | NO   |     | NULL    |                |
| payment_literal   | varchar(100)     | NO   |     | NULL    |                |
| bankname          | varchar(50)      | YES  |     | NULL    |                |
| bankacount_number | varchar(30)      | YES  |     | NULL    |                |
| checknumber       | varchar(30)      | YES  |     | NULL    |                |
| transferd_to      | varchar(50)      | YES  |     | NULL    |                |
| created           | date             | NO   |     | NULL    |                |
| user_id           | int(10) unsigned | NO   | MUL | NULL    |                |
+-------------------+------------------+------+-----+---------+----------------+

=================================
هعمل فاتوره المبيعات 


| app_sales_invoices | CREATE TABLE `app_sales_invoices` (
  `invoice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `paymentstatus` tinyint(1) NOT NULL,
  `created` date NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`invoice_id`),
  CONSTRAINT `app_sales_invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `app_clients` (`client_id`),
  CONSTRAINT `fk_invoices_sales_users_id` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`users_jd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |

===========================

هعمل فاتوره بالاصناف الي موجوده في فاتوره المبيعات

CREATE TABLE `app_sales_invoices_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` smallint(5) unsigned NOT NULL,
  `product_price` decimal(7,2) NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `app_sales_invoices_details_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `app_sales_invoices` (`invoice_id`),
  CONSTRAINT `app_sales_invoices_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `app_products_list` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

============================
هعمل بقي السند المبيعات
| app_sales_invoices_receipt | CREATE TABLE `app_sales_invoices_receipt` (
  `receip_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `payment_amount` decimal(8,2) NOT NULL,
  `payment_literal` varchar(100) NOT NULL,
  `bankname` varchar(50) DEFAULT NULL,
  `bankacount_number` varchar(30) DEFAULT NULL,
  `checknumber` varchar(30) DEFAULT NULL,
  `transferd_to` varchar(50) DEFAULT NULL,
  `created` date NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`receip_id`),
  CONSTRAINT `app_sales_invoices_receipt_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `app_sales_invoices` (`invoice_id`),
  CONSTRAINT `app_sales_invoices_receipt_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`users_jd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |

=============================
اخر جدول معانا هو التنبيهات
create table app_notification (
   notification_id int unsigned not null auto_increment primary key,
   title varchar(30) not null,
   content varchar(255) not null ,
   type tinyint(2) not null,
   created datetime not null,
   users_id int unsigned not null,
   foreign key(users_id) references app_users(users_id);
