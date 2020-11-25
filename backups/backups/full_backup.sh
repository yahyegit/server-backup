#!/bin/bash
mysqldump --user=phpmyadmin --password='#qX@#$QQdgg/.<q]&Aa3$%^sDVEg8SyCDX##' --host=localhost  --all-databases --routines| gzip > /var/www/backups/backups/full_sql_backup/MySQLDB_`date '+%m-%d-%Y'`.sql.gz
wget http://localhost/backups/send_full.php
