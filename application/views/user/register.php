<section id="login-section">
    <div class="site-width">

        <form id="login-form" method="post" action="">
            <?php
            if (isset($this->registration_error) && isset($_POST['csrf'])) {
                foreach ($this->registration_error as $key => $mes) {
                    ?>
                    <div class="notify">
                        <i class="fa fa-check"></i>
                        <?php
                        $this->L->prnt("reg_" . $mes['field'] . "_" . $mes['rule']);
                        ?>
                        <span class="close"><a href="#"><i class="fa fa-times"></i></a></span>
                    </div>
                <?php
                }
            } elseif (isset($_POST['csrf'])) {
                ?>
                <div class="notify">
                    <i class="fa fa-check"></i>
                    <?php
                    $this->L->prnt("reg_succes");
                    ?>
                    <span class="close"><a href="#"><i class="fa fa-times"></i></a></span>
                </div>
            <?php

            }
            ?>
            <label for="nickname"><?php $this->L->prnt("reg_ph_nick_pre"); ?></label>
            <input type="text" name="nickname" placeholder="<?php $this->L->prnt("reg_ph_nick"); ?>"
                   value="<?php echo isset($_POST['nickname']) ? $_POST['nickname'] : ""; ?>">
            <label for="password"><?php $this->L->prnt("reg_ph_pw_pre"); ?></label>
            <input type="password" name="password" placeholder="<?php $this->L->prnt("reg_ph_pw"); ?>">
            <label for="password_2"><?php $this->L->prnt("reg_ph_pw2_pre"); ?></label>
            <input type="password" name="password_2" placeholder="<?php $this->L->prnt("reg_ph_pw2"); ?>">
            <label for="first_name"><?php $this->L->prnt("reg_ph_fn_pre"); ?></label>
            <input type="text" name="first_name" placeholder="<?php $this->L->prnt("reg_ph_fn"); ?>"
                   value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ""; ?>">
            <label for="last_name"><?php $this->L->prnt("reg_ph_ln_pre"); ?></label>
            <input type="text" name="last_name" placeholder="<?php $this->L->prnt("reg_ph_ln"); ?>"
                   value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ""; ?>">
            <label for="birthday"><?php $this->L->prnt("reg_ph_bd_pre"); ?></label>
            <input type="text" name="birthday" placeholder="<?php $this->L->prnt("reg_ph_bd"); ?>"
                   value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : ""; ?>">
            <label for="email_address"><?php $this->L->prnt("reg_ph_email_pre"); ?></label>
            <input type="email" name="email_address" placeholder="<?php $this->L->prnt("reg_ph_email"); ?>"
                   value="<?php echo isset($_POST['email_address']) ? $_POST['email_address'] : ""; ?>">
            <input type="submit" value="<?php $this->L->prnt("reg_reg_button"); ?>">
            <?php echo $this->csrf->generateHiddenField(); ?>
        </form>
    </div>
</section>