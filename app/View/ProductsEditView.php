<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\View;
?>

<?php include 'layouts/menu.php'; ?>

<h1>
    Products Management panel: Edit product - <?php echo $data->get('name') ?>
</h1>
<div> <span>User:</span> <?= $_SESSION['login'] ?> </div>
<br/>
<div class="messages">
    <?php
    foreach($messages as $item){
        echo $item;
    }
    ?>
</div>
<br/>
<?php if(!empty($data->get('name'))){ ?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
<table>
    <tr>
        <td><label>Name</label></td>
        <td><input type="text" name="Product[name]"
                   value="<?php echo $data->get('name') ?>"/></td>
    </tr>
    <tr>
        <td><label>SKU</label></td>
        <td><input type="text" name="Product[sku]"
                   value="<?= $data->get('sku') ?>" /></td>
    </tr>
    <tr>
        <td><label>Status</label></td>
        <td>
            <select name="Product[status]" />
                <option value="1"
                    <?php if($data->get('status') == 1) echo 'selected';?>>
                    Enable
                </option>
                <option value="0"
                    <?php if($data->get('status') == 0) echo 'selected'; ?>>
                    Disable
                </option>
            </select>
        </td>
    </tr>
    <tr>
        <td><label>Description</label></td>
        <td><input type="text" name="Product[description]"
                   value=" <?= $data->get('description')?>"/></td>
    </tr>
    <tr>
        <td><label>Price</label></td>
        <td><input type="text" name="Product[price]"
                   value="<?= $data->get('price') ?>"/></td>
    </tr>
    <tr>
        <td><label>Last updated</label></td>
        <td><input type="text" name="Product[last_updated]"
                   value="<?= $data->get('last_updated')?>" readonly/></td>
    </tr>
</table>
    <br/>
<input type="submit" value="Save" />
 </form>
<?php } ?>