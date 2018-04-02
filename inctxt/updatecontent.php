<script src="/editor/e.js"></script>
<form id="form"  action="/<?=I_N?>urc/<?php echo $id; ?>/<?php echo $cid; ?>" method="post" onsubmit="DoProcess();">
 <table width="300" border="0" align="center" cellpadding="0" cellspacing="0"> <tr>
 <textarea id="content" name="content"  rows="12" cols="80" style="display:none;"><?php echo $rows['content']; ?></textarea>
<script type="text/javascript">
//<![CDATA[
		gFrame = 0;
		gContentId = "content";
		OutputEditorLoading();
		//]]>
</script>
<script type="text/javascript">
//<![CDATA[
var i = '<iframe id="HtmlEditor" class="editor_frame" frameborder="0" marginheight="0" marginwidth="0" style="width:98%;height:200px;overflow:visible;hidefocus:true;" ></iframe>';
document.write(i);
//]]>
</script>
                                                        </tr>
                                                        <tr>
                                                            <td width="71">time:</td>
                                                            <td width="223"><input name="tim" type="text" id="tim" value="<?php echo $v; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="71">reply name:</td>
                                                            <td width="223"><input name="rn" type="text" id="rn" value="<?php echo $rows['name']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td><input type="submit" name="Submit" value="change" style="border:1 solid;width:155;  cursor:hand;"></td>
                                                        </tr>
                                                    </table></form> 
