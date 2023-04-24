
--用業務id查詢商品銷售情況
SELECT a.SalesId , b.ItemsId , b.ItemsName , b.ItemsPrice ,c.ItemsQuantity , c.ItemsTotalMoney, c.CreatedTime FROM store AS a
JOIN items AS b ON a.StoreId = b.StoreId
JOIN order_content AS c ON b.ItemsId = c.ItemsId
WHERE a.SalesId = 3;