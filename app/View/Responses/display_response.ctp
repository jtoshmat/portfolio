<h2><?php echo __('Questions for selected products'); ?></h2>
<nav class="paging"><a class="previous_button" id="options_previous"  href="#">Previous</a><a class="next_button" id="submit-responses" href="#">Next</a></nav>
<div class="screenWrapper">   

<form class="forms"  id="answer-questions" name="agent" action="responses/createResponse" method="GET" style="width: 7460px; left: 0px;">
<fieldset id="responses">
<ul>
<?php
echo "<li>". $this->Form->input('Response.response_text', array('value'=>'Hello There')) ."</li>";

echo "<li>". $this->Form->input('Response.active', array('value'=>3)) ."</li>";
echo "<li>". $this->Form->input('Response.question', array('value'=>5)) ."</li>";

echo "<li>". $this->Form->input('Response.question_id', array('value'=>4)) ."</li>";
?>


</ul>
</fieldset>
</form>
    
 <?php echo $this->element('sql_dump'); ?>