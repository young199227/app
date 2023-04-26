
--請取出本月 A 店家的總營業額 a.StoreId=店家id
SELECT SUM(c.ItemsTotalMoney) AS total FROM store AS a
JOIN items AS b ON a.StoreId = b.StoreId
JOIN order_content AS c ON b.ItemsId = c.ItemsId
WHERE a.StoreId = 5
AND c.CreatedTime >= '2023-4-1'
AND c.CreatedTime < '2023-5-1';

--請取出 A 業務, A 店家, 上個月的 各品項銷售額
SELECT b.ItemsName , c.ItemsQuantity , c.ItemsTotalMoney ,c.CreatedTime 
FROM store AS a
JOIN items AS b ON a.StoreId = b.StoreId
JOIN order_content AS c ON b.ItemsId = c.ItemsId
JOIN sales AS d ON d.SalesId = a.SalesId
WHERE a.StoreId = 5
AND d.SalesId = 3
AND c.CreatedTime >= '2023-3-1'
AND c.CreatedTime < '2023-4-1';

--請取出 A 客人, 在 A店家, 本月 消費品項名稱
SELECT d.ItemsName , c.ItemsQuantity , c.ItemsTotalMoney , c.CreatedTime
FROM customer AS a
JOIN `order` AS b ON a.CustomerId = b.CustomerId
JOIN order_content AS c ON b.OrderId = c.OrderId 
JOIN items AS d ON d.ItemsId = c.ItemsId
JOIN store AS e ON e.StoreId = d.StoreId
WHERE a.CustomerId = 10
AND e.StoreId = 5
AND c.CreatedTime >= '2023-4-1'
AND c.CreatedTime < '2023-5-1';

--請用 insert into select 增加 B 業務 在 上月25日至28日 的訂單
INSERT INTO `order` (`CustomerId`, `OrderMoney` , `Copy` , `CreatedTime`)
SELECT 5, c.ItemsTotalMoney, 1, c.CreatedTime 
FROM store AS a
JOIN items AS b ON a.StoreId = b.StoreId
JOIN order_content AS c ON b.ItemsId = c.ItemsId
JOIN sales AS d ON d.SalesId = a.SalesId
WHERE d.SalesId = 3
AND c.CreatedTime >= '2023-3-25'
AND c.CreatedTime <= '2023-3-28';

--請刪除 上一個步驟 新增的 order.
DELETE FROM `order`
WHERE `CustomerId` = 5
AND `Copy` = 1
AND `CreatedTime` >= '2023-3-25'
AND `CreatedTime` <= '2023-3-28';

--請將 本月 A客人 1日的消費 改為上個月 30 日的消費
UPDATE `order` AS a
JOIN customer AS b ON b.CustomerId = a.CustomerId
JOIN order_content AS c ON c.OrderId = a.OrderId
SET c.CreatedTime = '2023-3-30' , a.CreatedTime = '2023-3-30' 
WHERE a.CustomerId = 5
OR c.CreatedTime = '2023-4-1'
OR a.CreatedTime = '2023-4-1';
