/*
* Insert client into clients table
*/
-- 1
insert into clients (client_first_name, client_last_name, client_email, client_password, client_level, comment) 
VALUES 
('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, 'I am the real Ironman');

-- 2
update clients
set client_level = 3
where client_last_name = 'Stark';

-- 3
update inventory
set invDescription = replace(invDescription, "small interior", "spacious interior")
where invId = 12;

-- 4
select invModel, classificationName
from inventory
    inner join carclassification 
    on inventory.classificationId = carclassification.classificationId   
where classificationName = "SUV";

-- 5
delete from inventory where invId = 1;

-- 6
update inventory 
set invImage = concat('/phpmotors', invImage),
invThumbnail = concat('/phpmotors', invImage);