<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\View;
?>
<?php use Cgi\Module\Url\Url;

include 'layouts/menu.php'; ?>

<h1>Products Management panel</h1>
<div> <span>User:</span> <?php echo $_SESSION['login'] ?> </div>
<br/>
<br/>

<table class="productsPanel">
    <tr>
        <th>ID</th>
        <th>
            <a href="<?php echo Url::getUrlSort() . 'sort=name&order=ASC' ?>">
                <img src="../../images/nup.jpg" />
            </a>
            Name
            <a href="<?php echo Url::getUrlSort() . 'sort=name&order=DESC' ?>">
                <img src="../../images/ndn.jpg" />
            </a>
        </th>
        <th>
            <a href="<?php echo Url::getUrlSort() . 'sort=price&order=ASC' ?>">
                <img src="../../images/pup.jpg" />
            </a>
            Price
            <a href="<?php echo Url::getUrlSort() . 'sort=price&order=DESC' ?>">
                <img src="../../images/pdn.jpg" />
            </a>
        </th>
        <th></th>
    </tr>
<?php
        foreach($data as $item){
        echo '<tr>';
        echo '<td>' . $item['id'] . '</td>';
        echo '<td>' . $item['name'] . '</td>';
        echo '<td>' . $item['price'] . '</td>';
        echo '<td><a href="/products/edit?id=' . $item['id'] . '">Edit</a></td>';
        echo '</tr>';
    }
?>
</table>
    <br/>

<div class="pagination">
<?php
foreach($pagination as $page){
    echo  $page;
}
?>
</div>
