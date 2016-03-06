<?php
use Cake\Core\Configure;

$this->layout = 'AdminLTE.login';

$script = <<<JAVASCRIPT
jQuery(function ($) {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue'
  });
});
JAVASCRIPT;

$this->Html->script('/AdminLTE/vendor/icheck/icheck.min', ['block' => true]);
$this->Html->css('/AdminLTE/vendor/icheck/skins/square/blue', ['block' => true]);
$this->Html->scriptBlock($script, ['block' => true])
?>

<div class="login-box-body">
    <?= $this->Flash->render('auth') ?>
    <p class="login-box-msg">
        Sign in to start your session
    </p>

    <?= $this->Form->create() ?>
        <div class="form-group has-feedback">
            <?= $this->Form->input('username', ['label' => false, 'placeholder' => __('Username')]); ?>
            <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $this->Form->input('password', ['label' => false, 'placeholder' => __('Password')]); ?>
            <span class="fa fa-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Remember Me
                    </label>
                </div>
            </div>
          <!-- /.col -->
          <div class="col-xs-4">
              <?= $this->Form->submit(__('Sign in'), ['class' => 'btn btn-primary btn-block btn-flat']) ?>
          </div>
          <!-- /.col -->
        </div>
    <?= $this->Form->end() ?>

    <?php
        if ($forgot = Configure::read('AdminLTE.links.forgot')) {
            echo $this->Html->link(
                Configure::read('AdminLTE.texts.forgot'),
                Configure::read('AdminLTE.links.forgot')
            );
        }
    ?>
</div>
