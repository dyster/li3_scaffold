<?=$this->form->create($model, array('method' => 'delete')); ?>
<?=$this->form->submit('Really Delete?'); ?>
<?=$this->form->hidden('id');?>
<?=$this->form->end(); ?>