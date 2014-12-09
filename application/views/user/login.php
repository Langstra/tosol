<section id="login-section">
    <div class="site-width">
        <form id="login-form" method="post" action="">
            <!--
            <ul id="login-alt">
                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Login with Facebook</a></li>
                <li><a href="#" class="googleplus"><i class="fa fa-google-plus"></i> Login with Facebook</a></li>
            </ul>
            -->

            <?php
            if (isset($this->login_error) && isset($_POST['csrf'])) {
                foreach ($this->login_error as $key => $mes) {
                    ?>
                    <div class="notify fail">
                        <i class="fa fa-check"></i>
                        <?php
                        $this->L->prnt("login_" . $mes['field'] . "_" . $mes['rule']);
                        ?>
                        <span class="close"><a href="#"><i class="fa fa-times"></i></a></span>
                    </div>
                <?php
                }
            } elseif (isset($_POST['csrf'])) {
                ?>
                <div class="notify success">
                    <i class="fa fa-check"></i>
                    <?php
                    $this->L->prnt("login_succes");
                    ?>
                    <span class="close"><a href="#"><i class="fa fa-times"></i></a></span>
                </div>
            <?php

            }
            ?>
            <label for="username"><?php $this->L->prnt("login_label_username"); ?></label>
            <input type="text" name="username" id="username" placeholder="<?php $this->L->prnt("login_ph_username"); ?>">
            <label for="password"><?php $this->L->prnt("login_label_password"); ?></label>
            <input type="password" name="password" id="password" placeholder="<?php $this->L->prnt("login_ph_password"); ?>">
            <input type="checkbox" name="" id="labelname" />
            <label for="labelname"><?php $this->L->prnt("login_label_remember"); ?></label><br>
            <input type="submit" name="submit" value="<?php $this->L->prnt("login_submit"); ?>">
            <br><a href="#"><?php $this->L->prnt("login_forget"); ?></a>
            <?php echo $this->csrf->generateHiddenField(); ?>
        </form>
    </div>
</section>