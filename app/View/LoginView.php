<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\View;
?>
<div class="messages"><?php echo $messages ?></div>

<div class="login">
<form method="post" action="/customer/login">
    <input type="text" name="Auth[email]" placeholder="E-mail"/>
    <input type="password" name="Auth[password]" placeholder="Password"/>
    <input type="submit" value="Войти" />
</form>
</div>