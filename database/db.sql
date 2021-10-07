      DROP TABLE IF EXISTS bank_statement;
      DROP TABLE IF EXISTS transfers;
      DROP TABLE IF EXISTS cards;
      DROP TABLE IF EXISTS user_friends;
      DROP TABLE IF EXISTS users;

      CREATE TABLE users(
            `id` INTEGER AUTO_INCREMENT,      
            `user_id` VARCHAR(64) UNIQUE,     
            `first_name` VARCHAR(20) not null,
            `last_name` VARCHAR(40) not null, 
            `user_name` VARCHAR(70) not null, 
            `birthday` VARCHAR(20) not null,  
            `password` VARCHAR(64) not null,  
            `is_client` boolean default true, 
            `created_at` timestamp default current_timestamp,
            `updated_at` timestamp default current_timestamp,

            primary key(id)
      );

      insert into users (first_name, last_name, birthday, password, user_name , user_id) VALUES
      ('João','das Neves', '1991-01-12','1231','joao_das_neves','1'),
      ('Maria','dos Santos', '1989-02-11','1232','maria_dos_santos','2'),
      ('Paulo','de Araújo', '1980-03-10','1233','paulo_de_araujo','3'),
      ('Helena','Cordeiro de Brito', '1985-04-09','1234','helena_cordeiro_de_brito','4'),
      ('Henrique','Meireles', '1979-05-08','1235','henrique_meireles','5');

      CREATE TABLE user_friends(
            `id` INTEGER AUTO_INCREMENT, 
            `user_id` INTEGER NOT NULL,  
            `friend_id` INTEGER NOT NULL,
            `created_at` timestamp default current_timestamp,
            `updated_at` timestamp default current_timestamp,
                           
            primary key(id)
      );

      insert into user_friends (user_id, friend_id) VALUES
      ('1','2'),
      ('1','4'),
      ('4','1'),
      ('4','3'),
      ('3','4'),
      ('2','1');

      CREATE TABLE cards(
            `id` INTEGER AUTO_INCREMENT,
            `card_id` VARCHAR(64) UNIQUE,
            `title` VARCHAR(20) not null,
            `pan` VARCHAR(50) not null,
            `expiry_mm` VARCHAR(30) not null,
            `expiry_yyyy` VARCHAR(20) not null,
            `security_code` VARCHAR(20) not null,
            `date` VARCHAR(20) not null,
            `created_at` timestamp default current_timestamp,
            `updated_at` timestamp default current_timestamp,

            PRIMARY KEY(id)
      );

      insert into cards (title, pan, expiry_mm, expiry_yyyy, security_code,date,card_id) VALUES
      ('Cartão 1','5527952393064634', '05','2022','656',"2015-11-26",'1'),
      ('Cartão 2','2379451656413535', '01','2025','654',"2015-05-12",'2'),
      ('Cartão 3','9978451345864468', '03','2025','185',"2015-06-11",'3'),
      ('Cartão 4','5523419975545166', '01','2024','143',"2015-07-10",'4'),
      ('Cartão 5','5527952393064634', '07','2025','357',"2015-08-09",'5');


      CREATE TABLE transfers(                          
            `id` INTEGER AUTO_INCREMENT,               
            `friend_id` VARCHAR(64) not null,          
            `total_to_transfer` FLOAT(8,2) not null,  
            `card_id` VARCHAR(64) not null,            
            `created_at` timestamp default current_timestamp,
            `updated_at` timestamp default current_timestamp,

            PRIMARY KEY(id)
      );

      insert into transfers (friend_id, total_to_transfer, card_id) values
      ('2',100.00,'1'),('4',100.00,'1');

      CREATE TABLE bank_statement(               
            `id` INTEGER AUTO_INCREMENT,         
            `user_id` VARCHAR(64) not null,               
            `friend_id` VARCHAR(64) not null,    
            `value` VARCHAR(50) not null,        
            `date` VARCHAR(20) not null,         
            `from_card` VARCHAR(64) not null,    
            `created_at` timestamp default current_timestamp,
            `updated_at` timestamp default current_timestamp,

            PRIMARY KEY(id) 
      );

      ALTER TABLE bank_statement ADD FOREIGN KEY (user_id) REFERENCES users(user_id);
      ALTER TABLE bank_statement ADD FOREIGN KEY (friend_id) REFERENCES users(user_id);

      insert into bank_statement (user_id, friend_id, value, date, from_card) VALUES
      ('1','2', '150.25',"2021-08-30",'1'),
      ('1','4', '235.65',"2021-04-26",'1'); 
