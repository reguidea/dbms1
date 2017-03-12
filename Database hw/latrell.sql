set echo on

connect system/amakal

--Create PHP Application User 
Drop user Latrell cascade;
create user Latrell identified by welcome;
grant DBA to Latrell;
alter user Latrell default tablespace users temporary tablespace temp account unlock;

Drop user Nyx cascade;
create user Nyx identified by welcome;
grant connect,resource to Nyx;
alter user Nyx default tablespace users temporary tablespace temp account unlock;

connect Latrell/welcome;
create table user_authentication (id_num varchar2 (50) primary key
username varchar2 (50) not null,
password varchar2(20) not null,
last_name varchar2 (50),
f_name varchar2 (50),);

insert into user_authentication values (1,"latrell","salosagcol","latrell","salosagcol");
insert into user_authentication values (2,"Nyx","laurel","latrell","salosagcol");
commit;


Connect php_sec_admin/welcome;

Create table products (ID_number varchar2 (20) primary key,
 Prod_name varchar2(1000) not null,
 Prod_category varchar2 (20);
 Unit varchar2 (20),
 Unit_price varchar2 (5,2)not null);
 
insert into products(id,Prod_name,Prod_cat,Prod_name)
 values(1,"Flash","Drive","%%%");
insert into products(id,Prod_name,Prod_cat,Prod_name)
 values(1,"BenQ","Monitor","***");
 insert into products(id,Prod_name,Prod_cat,Prod_name)
 values(1,"Mechanical","Keyboard","***");
 insert into products(id,Prod_name,Prod_cat,Prod_name)
 values(1,"Surround","Speaker","%%%");
 insert into products(id,Prod_name,Prod_cat,Prod_name)
 values(1,"Nvidia","Graphics Card","$$$");
 insert into products(id,Prod_name,Prod_cat,Prod_name)
 values(1,"PS4","Controller","***");

commit;

grant select on php_authentication to phpuser;