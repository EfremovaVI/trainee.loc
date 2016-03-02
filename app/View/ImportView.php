<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\View;
?>

<?php include 'layouts/menu.php'; ?>

<h1>Products Management panel: Import</h1>
<div> <span>User:</span> <?= $_SESSION['login'] ?> </div>
<br/>
<div class="messages">
<?php
    foreach($messages as $item){
        echo $item;
    }
?>
</div>
<div class="error">
    <form method="post" action="/products/import">
        <label>Magento Base URL:</label>
        <input type="text" name="Import[url]"/>
        <input type="submit" value="Import products" />
    </form>
</div>
