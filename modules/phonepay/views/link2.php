<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?init_head()?>
<div class="row">
    <!-- Merchant ID -->
    <?php ' <div class="col-12 mbottom5">
            <div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('phonepay') . '">
            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="phonepe" checked>
            </div>
            <label class="onoffswitch-label" for="phonepe"></label>
        </div>' ?>
    <div class='col-md-6'>
        <?= render_input(
            'merchant_id',
            _l('phonepe_merchant_id') . ":",
            '',
            'number',
            [
                'id' => 'merchant_id',
                'placeholder' => _l('phonepe_merchant_id'),
            ]
        ) ?>
    </div>
    <!-- Phonepe Env -->
    <div class='col-md-6'>
        <?= render_input(
            'env',
            _l('phonepe_merchant_env') . ":",
            '',
            'number',
            [
                'id' => 'env',
                'placeholder' => _l('phonepe_merchant_env'),
            ]

        ) ?>
    </div>
    <!-- Phonepe salt index -->
    <div class='col-md-6'>
        <?= render_input(
            'salt_index',
            _l('phonepe_salt_index') . ":",
            '',
            'number',
            [
                'id' => 'salt_index',
                'placeholder' => _l('phonepe_salt_index'),
            ]

        ) ?>
    </div>
    <!-- Phonepe user id -->
    <div class='col-md-6'>
        <?= render_input(
            'user_id',
            _l('phonepe_merchant_user_id') . ":",
            '',
            'text',
            [
                'id' => 'user_id',
                'placeholder' => _l('phonepe_merchant_user_id'),
            ]

        ) ?>
    </div>
    <!-- Salt key -->
    <div class='col-md-6'>
        <?= render_input(
            'salt_key',
            _l('phonepe_salt_key') . ":",
            '',
            'text',
            [
                'id' => 'salt_key',
                'placeholder' => _l('phonepe_salt_key'),
            ]
        ) ?>
    </div>
</div>