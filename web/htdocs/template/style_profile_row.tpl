
<LINK REL="stylesheet" href="css/page_style.css" TYPE="text/css">

<table width="600" border="0">
  <tr>
    <td colspan="5"><div id="flash_stylerow_<?php echo $this->style_rowid?>"></div></td>
  </tr>
  <tr>
  <?php for($i=0 , $style_datas ; $i < $style_rownum ; $i++): ?>
    <td width="120">
	<?php if(!$style_datas[$i]) continue; ?>
	<span class="stl_no">NO. <?php echo $style_datas[$i]['id']?> <br/></SPAN>
	<p style="margin-top: -5px; margin-bottom: -5px">　</p>
	<SPAN class="stl_pname"><?php echo $style_datas[$i]['name']?><br/></SPAN>
	<SPAN class="stl_pcontain"><?php echo $style_datas[$i]['age']?> 歲</SPAN>
	<SPAN class="stl_pcontain"><?php echo $style_datas[$i]['tall']?>cm</SPAN> </td>
    <?php endfor ; ?>
  </tr>
</table> 


  <script type="text/javascript" language="javascript">
	var swfurl="swf/style_row.swf";
	var fo = new FlashObject(swfurl,"stylerow_<?php echo $style_rowid?>","600","180","8","#FFFFFF");
	fo.addVariable("path", "<?php echo $style_path?>");
	fo.addVariable("link", '<?php echo $style_link?>');
	fo.write("flash_stylerow_<?php echo $style_rowid?>");
</script>


