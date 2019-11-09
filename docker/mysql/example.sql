--
-- Database: example
--
create database example;
use example;

--
-- User: hoge
--
CREATE USER `hoge` IDENTIFIED BY 'development';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, REFERENCES, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE ON `example`.* TO `hoge` identified by 'development';
