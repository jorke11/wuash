create view vcities as 
select c.id,c.description city,d.description department,c.code
from cities c
join departments d ON d.id=c.department_id;


--﻿﻿drop view vclient
CREATE VIEW vclient AS
SELECT s.id,s.business_name,s.business,coalesce(s.name,'') as name,coalesce(s.last_name,'') as last_name,s.document,s.email,coalesce(s.address_send,'') as address,s.phone,
s.contact,s.phone_contact,s.term,c.description as city,s.web_site,coalesce(typeperson.description,'') as typeperson,typeregime.description as typeregime,
typestakeholder.description as typestakeholder,status.description as status,s.responsible_id,coalesce(u.name,'') ||' '||coalesce(u.last_name,'') as responsible,
s.created_at,s.address_invoice,send.description city_invoice,s.updated_at
FROM stakeholder s
LEFT JOIN cities c ON c.id=s.city_id
LEFT JOIN cities send ON send.id=s.invoice_city_id
LEFT JOIN users as u ON u.id=s.responsible_id
LEFT JOIN parameters as typeperson ON typeperson.code=s.type_person_id and typeperson."group"='typeperson'
LEFT JOIN parameters as typeregime ON typeregime.code=s.type_regime_id and typeregime."group"='typeregime'
LEFT JOIN parameters as typestakeholder ON typestakeholder.code=s.type_stakeholder and typestakeholder."group"='typestakeholder'
LEFT JOIN parameters as status ON status.code=s.status_id and status."group"='generic'
WHERE s.type_stakeholder=1 


create view vorders as
select o.id,o.plate,p.description type_vehicle, o.hour,o.day,st.description status
from orders o
JOIN parameters p ON p.code=o.type_vehicle_id AND p.group='type_vehicle'
JOIN parameters st ON st.code=o.status_id AND st.group='status_order'
	

--drop view vproducts
create view vproducts as
select p.id,p.title,substring(p.description from 1 for 30) || ' ...' as description,s.business as supplier,p.reference,p.bar_code,p.units_supplier,p.units_sf,
p.cost_sf,p.tax,p.price_sf,
(select path from products_image where product_id=p.id and main=true limit 1) as image,
(select thumbnail from products_image where product_id=p.id and main=true limit 1) as thumbnail,status.description as status,p.status_id,p.category_id,p.supplier_id,
p.short_description,p.warehouse
from products p
JOIN stakeholder s ON s.id=p.supplier_id
LEFT JOIN parameters as status ON status.code=p.status_id and status."group"='generic'
WHERE p.type_product_id IS NULL


create view vservices as
select p.id,p.title,substring(p.description from 1 for 30) || ' ...' as description,s.business as supplier,p.reference,p.bar_code,p.units_supplier,p.units_sf,p.cost_sf,p.tax,p.price_sf,
p.image,status.description as status
from products p
JOIN stakeholder s ON s.id=p.supplier_id
LEFT JOIN parameters as status ON status.code=p.status_id and status."group"='generic'
WHERE p.type_product_id IS NOT NULL