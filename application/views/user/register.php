<!-- Layout -->
<div class="site-width">
    <div class="g-r" id="main-body">
        <div class="col-12" id="main-content">
            <div class="module-area">
                <h2><?php $this->L->prnt("reg_header"); ?></h2>
                <form method="post" action="">
                    <input type="text" name="nickname" placeholder="<?php $this->L->prnt("reg_ph_nick"); ?>">
                    <input type="password" name="password" placeholder="<?php $this->L->prnt("reg_ph_pw"); ?>">
                    <input type="password" name="password_2" placeholder="<?php $this->L->prnt("reg_ph_pw2"); ?>">
                    <input type="text" name="first_name" placeholder="<?php $this->L->prnt("reg_ph_fn"); ?>">
                    <input type="text" name="last_name" placeholder="<?php $this->L->prnt("reg_ph_ln"); ?>">
                    <input type="date" name="birthday" placeholder="<?php $this->L->prnt("reg_ph_bd"); ?>">
                    <input type="email" name="email_address" placeholder="<?php $this->L->prnt("reg_ph_email"); ?>">
                    <input type="submit" value="<?php $this->L->prnt("reg_reg_button"); ?>">
                    <?php echo $this->csrf->generateHiddenField(); ?>
                </form>
            </div>
        </div>

    </div>
</div>