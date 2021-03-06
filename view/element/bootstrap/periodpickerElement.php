<?php
    $e = $this->element;
    $e->setAttribute('class', $e->getAttribute('class').' form-control');
    $label = ($e->getLabel() ? $this->translate($e->getLabel()) : "");
    $extended = $e->getOption('extended');
    $date_format = $extended['date-format'];
    $err = (count($e->getMessages()) > 0) ? $e->getMessages() : false;
    if(!isset($extended['help'])){
        $extended['help'] = array('content' => '&nbsp;');
    }
    
    $value = $e->getValue();
?>
<div class="elementWrapper">
    <div class="input-group">
        <input class="form-control" id="<?=$e->getAttribute('id')?>" name="<?=$e->getAttribute('name')?>_start" type="text" value="<?=$value?>" data-date-format="<?=$date_format?>">
        <input class="form-control" id="<?=$e->getAttribute('id')?>" name="<?=$e->getAttribute('name')?>_end" type="text" value="<?=$value?>" data-date-format="<?=$date_format?>">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
        </span>
    </div>
    <span class="help-block" style="display:none;">
        <?=$this->translate($extended['help']['content'])?>
    </span>
    
    
    <?php if($err) { ?>
    <span class="help-block with-errors" style="display:none;">
    <?php foreach($err as $k => $v) { 
            echo $this->translate($v);
        } ?>
    </span>
<?php } ?>
</div>
