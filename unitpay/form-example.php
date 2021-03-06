<?php include_once 'lib/ConfigWritter.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>UnitPay - Электронные платежи и SMS-биллинг на лучших условиях</title>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
</head>
<body>

<h2>Форма</h2>
<form action="https://unitpay.ru/pay/<?php echo ConfigWritter::getInstance()->getParameter('PROJECT_ID');?>" method="post">
    <label for="account">Номер счета</label> <input type="text" name="account" value="ivan@gmail.com"><br>
    <label for="sum">Сумма платежа</label> <input type="text" name="sum" value="50"><Br>
    <input type="hidden" name="desc" value="Покупка внутриигровой валюты">
    <input class="btn" type="submit" value="Оплатить">
</form>
<pre class="prettyprint linenums">
&lt;form action=&quot;https://unitpay.ru/pay/<?php echo ConfigWritter::getInstance()->getParameter('PROJECT_ID');?>&quot; method=&quot;post&quot;&gt;
    &lt;label for=&quot;account&quot;&gt;Номер счета&lt;/label&gt; &lt;input type=&quot;text&quot; name=&quot;account&quot; value=&quot;ivan@gmail.com&quot;&gt;&lt;br&gt;
    &lt;label for=&quot;sum&quot;&gt;Сумма платежа&lt;/label&gt; &lt;input type=&quot;text&quot; name=&quot;sum&quot; value=&quot;50&quot;&gt;&lt;Br&gt;
    &lt;input type=&quot;hidden&quot; name=&quot;desc&quot; value=&quot;Покупка внутриигровой валюты&quot;&gt;
    &lt;input class=&quot;btn&quot; type=&quot;submit&quot; value=&quot;Оплатить&quot;&gt;
&lt;/form&gt;
</pre>
<p>Обратите внимание на скрытое поле "desc", в котором заранее установлена информация о покупке.
    Подобным образом можно спрятать поля "account" и "sum", заранее прописав в них требуемые значения, в зависимости от специфики
    Вашего проекта.</p>
<a name="game1"></a>
<h2>Форма с предустановленной стоимостью <br>(пример для игрового сервера)</h2>
<form action="https://unitpay.ru/pay/<?php echo ConfigWritter::getInstance()->getParameter('PROJECT_ID');?>" method="post">
    <label for="account">Ник персонажа</label> <input type="text" id="account" name="account" value=""><br>
    <label for="sum">Количество монет</label>
    <select id="sum" name="sum">
        <option value="30">1 монета</option>
        <option value="60">2 монеты</option>
        <option value="90">3 монеты</option>
        <option value="150">5 монет</option>
        <option value="300">10 монет</option>
    </select><br>
    <input type="hidden" name="desc" value="Покупка внутриигровой валюты">
    <input class="btn" type="submit" value="Оплатить">
</form>
<pre class="prettyprint linenums">
&lt;form action=&quot;https://unitpay.ru/pay/<?php echo ConfigWritter::getInstance()->getParameter('PROJECT_ID');?>&quot; method=&quot;post&quot;&gt;
    &lt;label for=&quot;account&quot;&gt;Ник персонажа&lt;/label&gt; &lt;input type=&quot;text&quot; id=&quot;account&quot; name=&quot;account&quot; value=&quot;&quot;&gt;&lt;br&gt;
    &lt;label for=&quot;sum&quot;&gt;Количество монет&lt;/label&gt;
    &lt;select id=&quot;sum&quot; name=&quot;sum&quot;&gt;
        &lt;option value=&quot;30&quot;&gt;1 монета&lt;/option&gt;
        &lt;option value=&quot;60&quot;&gt;2 монеты&lt;/option&gt;
        &lt;option value=&quot;90&quot;&gt;3 монеты&lt;/option&gt;
        &lt;option value=&quot;150&quot;&gt;5 монет&lt;/option&gt;
        &lt;option value=&quot;300&quot;&gt;10 монет&lt;/option&gt;
    &lt;/select&gt;&lt;br&gt;
    &lt;input type=&quot;hidden&quot; name=&quot;desc&quot; value=&quot;Покупка внутриигровой валюты&quot;&gt;
    &lt;input class=&quot;btn&quot; type=&quot;submit&quot; value=&quot;Оплатить&quot;&gt;
&lt;/form&gt;
</pre>
<p>Обратите внимание, что в примере показан классический случай с ценой 1 монеты в 30 руб. Если цена другая, то нужно
    заменить цифры 30, 60, 90, 150, 300 на P, P*2, P*3, P*5, P*10 соотвественно, где P цена вашей монеты. Также Вы можете добавить свои
    линейки тарифов, например:</p>
<pre class="prettyprint linenums">
&lt;option value=&quot;900&quot;&gt;30 монет&lt;/option&gt;
&lt;option value=&quot;1500&quot;&gt;50 монет&lt;/option&gt;
</pre>
<a name="game2"></a>
<h2>Форма с плавающей стоимостью <br>(пример для игрового сервера)</h2>

<script type="text/javascript">
    $(function () {
        function calculateBonuses() {
            var coinPrice = parseFloat($('#unitpayForm #coinPrice').val());
            var coins = parseInt($('#unitpayForm #coins').val());
            if (isNaN(coins) || isNaN(coinPrice) || coins <= 0) {
                $('#unitpayForm #sum').val('');
                return;
            }
            var price = coins * coinPrice;
            if (price > 15000) {
                price = 15000;
            }
            $('#unitpayForm #sum').val(price);
        }
        $('#unitpayForm input#coins').keyup(function () {
            calculateBonuses();
        });
        calculateBonuses();
        $('#unitpayForm').submit(function(){
            var sum = parseFloat($('#unitpayForm #sum').val());
            if (isNaN(sum) || sum <= 0 || sum > 15000) {
                alert('Неверная сумма платежа');
                return false;
            }
        });
    });
</script>

<form id="unitpayForm" action="https://unitpay.ru/pay/<?php echo ConfigWritter::getInstance()->getParameter('PROJECT_ID');?>" method="post">
    <label for="account">Ник персонажа:</label> <input type="text" value="" name="account" required="required" id="account"><br>
    <label for="coins">Количество монет:</label>
    <input type="text" id="coins" name="coins" value="10" required="required"><br>
    <input type="hidden" id="sum" name="sum" value="">
    <input type="hidden" id="coinPrice" name="coinPrice" value="30">
    <input type="hidden" name="desc" value="Покупка внутриигровой валюты">
    <input type="submit" class="btn" value="Оплатить">
</form>

<pre class="prettyprint linenums">
&lt;script src=&quot;http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js&quot;&gt;&lt;/script&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
    $(function () {
        function calculateBonuses() {
            var coinPrice = parseFloat($('#unitpayForm #coinPrice').val());
            var coins = parseInt($('#unitpayForm #coins').val());
            if (isNaN(coins) || isNaN(coinPrice) || coins &lt;= 0) {
                $('#unitpayForm #sum').val('');
                return;
            }
            var price = coins * coinPrice;
            if (price &gt; 15000) {
                price = 15000;
            }
            $('#unitpayForm #sum').val(price);
        }
        $('#unitpayForm input#coins').keyup(function () {
            calculateBonuses();
        });
        calculateBonuses();
        $('#unitpayForm').submit(function(){
            var sum = parseFloat($('#unitpayForm #sum').val());
            if (isNaN(sum) || sum &lt;= 0 || sum &gt; 15000) {
                alert('Неверная сумма платежа');
                return false;
            }
        });
    });
&lt;/script&gt;

&lt;form id=&quot;unitpayForm&quot; action=&quot;https://unitpay.ru/pay/<?php echo ConfigWritter::getInstance()->getParameter('PROJECT_ID');?>&quot; method=&quot;post&quot;&gt;
    &lt;label for=&quot;account&quot;&gt;Ник персонажа:&lt;/label&gt; &lt;input type=&quot;text&quot; value=&quot;&quot; name=&quot;account&quot; required=&quot;required&quot; id=&quot;account&quot;&gt;
    &lt;label for=&quot;coins&quot;&gt;Количество монет:&lt;/label&gt;
    &lt;input type=&quot;text&quot; id=&quot;coins&quot; name=&quot;coins&quot; value=&quot;10&quot; required=&quot;required&quot;&gt;
    &lt;input type=&quot;hidden&quot; id=&quot;sum&quot; name=&quot;sum&quot; value=&quot;&quot;&gt;
    &lt;input type=&quot;hidden&quot; id=&quot;coinPrice&quot; name=&quot;coinPrice&quot; value=&quot;30&quot;&gt;
    &lt;input type=&quot;hidden&quot; name=&quot;desc&quot; value=&quot;Покупка внутриигровой валюты&quot;&gt;
    &lt;input type=&quot;submit&quot; class=&quot;btn&quot; value=&quot;Оплатить&quot;&gt;
&lt;/form&gt;
</pre>
<p>Обратите внимание, что цена монеты задается в скрытом поле input с ID "coinPrice".</p>

</body>
</html>
