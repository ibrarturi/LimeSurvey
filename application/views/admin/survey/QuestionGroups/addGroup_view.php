<?php echo PrepareEditorScript(false, $this);?>
<div class='header ui-widget-header'><?php $clang->eT("Add question group"); ?></div>
<div id='tabs'><ul>
    <?php foreach ($grplangs as $grouplang)
        { ?>
            <li><a href="#<?php echo $grouplang; ?>"><?php echo GetLanguageNameFromCode($grouplang,false);
            if ($grouplang==$baselang) { ?>(<?php $clang->eT("Base language"); ?>) <?php } ?>
            </a></li>
        <?php }
    if (bHasSurveyPermission($surveyid,'surveycontent','import'))
    { ?>
        <li><a href="#import"><?php $clang->eT("Import question group"); ?></a></li>

   	<?php } ?>
    </ul>



    <form action='<?php echo $this->createUrl("admin/questiongroup/sa/insert/surveyid/".$surveyid); ?>' class='form30' id='newquestiongroup' name='newquestiongroup' method='post' onsubmit=" if (1==0

    <?php foreach ($grplangs as $grouplang)
    { ?>
        || document.getElementById('group_name_$grouplang').value.length==0
    <?php } ?>
     ) { alert ('<?php $clang->eT("Error: You have to enter a group title for each language.",'js'); ?>'); return false;}" >

    <?php
    foreach ($grplangs as $grouplang)
    { ?>
        <div id="<?php echo $grouplang; ?>">
        <ul>
        <li>
        <label for='group_name_$grouplang'><?php $clang->eT("Title:"); ?></label>
        <input type='text' size='80' maxlength='100' name='group_name_<?php echo $grouplang; ?>' id='group_name_<?php echo $grouplang; ?>' /><font color='red' face='verdana' size='1'> <?php $clang->eT("Required"); ?></font></li>
        <li><label for='description_<?php echo $grouplang; ?>'><?php $clang->eT("Description:"); ?></label>
        <textarea cols='80' rows='8' id='description_<?php echo $grouplang; ?>' name='description_<?php echo $grouplang; ?>'></textarea>
        <?php echo getEditor("group-desc","description_".$grouplang, "[".$clang->gT("Description:", "js")."](".$grouplang.")",$surveyid,'','',$action); ?>
        </li>
        <?php if ($grouplang==$baselang){?>
                  <li><label for='randomization_group'><?php $clang->eT("Randomization group:"); ?></label><input type='text' size='20' maxlength='20' name='randomization_group' id='randomization_group' /></li>
        <?php } ?>
        </ul>
        <p><input type='submit' value='<?php $clang->eT("Save question group"); ?>' />
        </div>
    <?php } ?>

    </form>



    <?php if (bHasSurveyPermission($surveyid,'surveycontent','import'))
    { ?>
        <div id="import">
        <form enctype='multipart/form-data' class='form30' id='importgroup' name='importgroup' action='<?php echo $this->createUrl('admin/questiongroup/sa/import'); ?>' method='post' onsubmit='return validatefilename(this,"<?php $clang->eT('Please select a file to import!','js'); ?>");'>
        <ul>
        <li>
        <label for='the_file'><?php $clang->eT("Select question group file (*.lsg/*.csv):"); ?></label>
        <input id='the_file' name="the_file" type="file" size="35" /></li>
        <li><label for='translinksfields'><?php $clang->eT("Convert resource links?"); ?></label>
        <input id='translinksfields' name="translinksfields" type="checkbox" checked="checked"/></li></ul>
        <p><input type='submit' value='<?php $clang->eT("Import question group"); ?>' />
        <input type='hidden' name='action' value='importgroup' />
        <input type='hidden' name='sid' value='<?php echo $surveyid; ?>' />
        </form>

        </div>
    <?php } ?>




    </div>