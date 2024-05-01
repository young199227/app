--查出3號會員購物車裡面的商品
SELECT a.*, b.*, 
    (SELECT goods_img FROM goods_imges WHERE goods_id = b.goods_id LIMIT 1) AS goods_img
FROM goods_car AS a
JOIN goods AS b ON a.Goods_id = b.Goods_id
WHERE a.Member_id = 3;