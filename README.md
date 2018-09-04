# SRS_Helper

## Installation 

In order to install the module you just need to add to your composer.json the following line:

```
"repositories": [
    { "type": "git", "url": "git@github.com:ESUCC/SRS_Helper.git" }
],
"require": [
  ...,
  ...,
  ...,
  "SRS/forms": "master"
]  
```
Then you can just type:
```
composer update
```
and the module will be automatically installed for you.

After that you can add the module to your application. On file **config/modules.config.php** add SRS\Forms module.

Also it is necessary to copy the content from the folder assets from this module to your public folder and have them 

## Using the renderer in your view

Now to use the the helpers in your view you on the top of your view file you will need to add the following code:
```
<?php
$form = $this->form;
$renderer = $this->formRenderer($form, 'renderer.bootstrap');
$renderer->prepare();
?>
```
Now to render a file you simple use the form the renderer we just created and call the desired helper, for example:

```
<?= $renderer->formRow($form->date_notice, 3, 9) ?>
<?= $renderer->formRow($form->date_notice, 3, 9) ?>
<?= $renderer->formGroup($form->get('sc_name')); ?>
```

## Types of helpers avaiable

### formRow($element, $colsLabel, $colsElement)

This helper will create a bootstrap row with label on the left and element on the right, you decide the size of the label by saying the number of bootstrap cols you want and then size of the Element by saying the number of bootstrap cols you want.

For example: I modified form034 to use the renderer and change the part of the code to look like this:

```
    <?= $renderer->formRow($form->date_notice, 3, 9) ?>

    <?= $renderer->formRow($form->describe_action, 3, 9) ?>

    <?= $renderer->formRow($form->describe_reason, 3, 9) ?>

    <?= $renderer->formRow($form->options_other, 3, 9) ?>

    <?= $renderer->formRow($form->justify_action, 3, 9) ?>

    <?= $renderer->formRow($form->other_factors, 3, 9) ?>
```

The result will be like this
![alt text](https://github.com/ESUCC/SRS_Helper/raw/master/images/screenshot_form034.png)

### formGroup($element)

This helper will create label + element html, showing label on top and element on bottom, it does not create any grid classes for you, so it gives more flexiblity to designe your form the way you want.
Example of code:
```
<div class="row">
    <div class="col-xs-6">
        <div class="row">
            <div class="col-xs-12">
                <?= $formRenderer->formGroup($form->get('sc_name')); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <?= $formRenderer->formGroup($form->get('sc_phone')); ?>
            </div>
            <div class="col-xs-6">
                <?= $formRenderer->formGroup($form->get('sc_agency')); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <?= $formRenderer->formGroup($form->get('sc_address')); ?>
    </div>
</div>
```
It will give you a result like this:
![alt text](https://github.com/ESUCC/SRS_Helper/raw/master/images/screenshot_form13.png)
