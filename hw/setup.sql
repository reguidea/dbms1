set echo on

connect system/moogz
--Create PHP Application User
drop user Migz cascade;
create user Migz identified by Miggy;
grant connect, resource to Migz;
alter user Migz default tablespace users
	temporary tablespace temp account unlock;

	
--Create user owner security info about the application
drop user Migz_admin cascade;
create user Migz_admin identified by Miggy;
alter user Migz_admin default tablespace system
	temporary tablespace temp account unlock;
grant create procedure, create session, create table, resource,
	select any dictionary to Migz_admin;
	
connect Migz_admin/Miggy;
--"Parts" table for the application demo
create table gundam(id number primary key,gundam_meister varchar2(40),gundam_name varchar2(40));

  insert into gundam values(1,'Tieria','Dominique');
  insert into gundam values(2,'Setsuna','Exia');
  insert into gundam values(3,'Lockon','Zabanya');
  insert into gundam values(4,'Allelujah','Harute');
  insert into gundam values(5,'Mikazuki','Barbatos');
  insert into gundam values(6,'Gaelio','Kimaris');
  commit;
  
  connect Migz_admin/Miggy;
  
commit;

grant select on gundam to Migz;
