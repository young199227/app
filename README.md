<p align="center"><img src="https://raw.githubusercontent.com/young199227/app/main/public/img/tree.png" height="150px"></p>

 **Fruit World**
===

<div class="">專題網址：<a href="http://43.206.108.197/">http://43.206.108.197/</a></div>
<div class="mt-2">GitHub：<a href="https://github.com/young199227/app">https://github.com/young199227/app</a></div>

---
<br>

**專題簡介**
<br>

<p>這是一個在LAMP環境下寫的水果購物網站專題(Linux + Apache + MySQL + PHP)</p>  

<p>使用了laravel框架,架設在aws雲端(網址ip問題是因為沒錢買網域QQ)</p>  

<p>快速測試請使用以下二組帳號<br>網站管理者－帳號：owner 密碼：123456<br>內建會員－帳號：123 密碼：123456</p>  

<p>下面是網站詳細內容</p>
<br>

---

**ER Model**
<br>

<p><img src="https://raw.githubusercontent.com/young199227/app/main/public/img/ER%E9%97%9C%E8%81%AF%E5%9C%96.png" width="704px"></p>
<br>

---
**網站頁面簡介**
<br>

1. 形象頁面（引導進入網站）
2. 商場首頁（輪播圖、多樣分類）
3. 商品列表（價錢分類、項目分類）
4. 商品查詢（可直接查詢相關名稱、搜尋欄）
5. 商品獨立頁面（預覽圖片、名稱、金額、產地、紙箱規格表、購物車、直購：如購物車內有相同商品直接上加）
6. 商品購物車（可直接更改商品數量、數量最多限制為五箱、刪除商品）
7. 會員中心頁面（會員專屬）
8. 後台頁面（網站管理者專屬）

<br>

---
**三種使用者簡介**
<br>
<br>

### **非會員**
1. 遊覽網站、觀看商品
2. 可查詢商品（查詢”果”：蘋果、富士蘋果⋯⋯）
3. 註冊功能（驗證信箱、驗證碼功能、限制密碼長度６～１２）
4. 登入功能（執行註冊完後自動跳轉登入頁面，或網站首頁右上登入）
5. 點擊購物車、直接購買商品 跳轉註冊畫面（判斷有無會員）

<br>

### **會員（內建會員 帳號:123 密碼:123456）**
1. 使用購物車（可更改商品數量、刪除）
2. 下訂單購買商品（訂單確認內容金額、勾選確認送出）
3. 瀏覽過往訂單（包含金額、收件人、電話、地址、訂單狀態、購物商品）
4. 修改密碼（須有舊密碼、新密碼、確認密碼）
5. 會員中心（可看註冊信箱）
6. 置頂購物車紅點（顯示購物車內有多少商品）

<br>

### **網站管理者（帳號:owner 密碼:123456）**

1. 上傳商品（設置圖片、名稱、產地、數量、敘述）
2. 管理商品（修改商品內容、可上下架商品（下架後商品列表會消失））
3. 管理會員（正常使用、停權（無法登入））
4. 管理訂單（修改狀態：進行中、完成、取消）
5. 數據統計（數據整合：可看項目總數ex.會員數量、商品上下架數量）


<br>
---
**設定事項說明**
<br>

1. 於項目的根目錄新增一個 .env 設定（SQL等等...）

    DB_CONNECTION設定時注意環境 /config/database.php (不同的sql 還有"mac!!!")

    新設定一個 APP_KEY  指令：php artisan key:generate

2. 使用終端機到項目的根目錄，輸入指令：composer install

    此命令將在項目根目錄中創建 vendor 目錄，並下載和安裝 Laravel 及其相依套件的所有依賴項。

3. 上傳檔案的路徑設定/config/filesystems.php

    指令：php artisan storage:link

4. session api.php的路由是不能設定的 

5. 寄email設定.env

    MAIL_MAILER=smtp <br>
    MAIL_HOST=smtp.gmail.com <br>
    MAIL_PORT=587 <br>
    MAIL_USERNAME=ggyy的email <br>
    MAIL_PASSWORD=nomfxpftiuvgoihx <br>
    MAIL_ENCRYPTION=tls <br>
    MAIL_FROM_ADDRESS=null <br>
    MAIL_FROM_NAME="${APP_NAME}"






