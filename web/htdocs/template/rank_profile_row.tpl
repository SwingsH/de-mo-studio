
<LINK REL="stylesheet" href="css/page_style.css" TYPE="text/css">

<table width="600" border="0">
  <tr>
    <td colspan="5"><div id="flash_stylerow_<?php echo $rank_rowid?>"></div></td>
  </tr>
  <tr>
  <?php for($i=0 , $rank_datas ; $i < $rank_rownum ; $i++): ?>
    <td width="120">
	<?php if(!$rank_datas[$i]) continue; ?>
	<span class="stl_no">NO. <?php echo $rank_datas[$i]['id']?> <br/></SPAN>
	<p style="margin-top: -5px; margin-bottom: -5px">　</p>
	<SPAN class="stl_pname"><?php echo $rank_datas[$i]['name']?><br/></SPAN>
	<SPAN class="stl_pcontain"><?php echo $rank_datas[$i]['vote']?> 票</SPAN>
	</td>
    <?php endfor ; ?>
  </tr>
</table> 


  <script type="text/javascript" language="javascript">
	var swfurl="swf/style_row.swf";
	var fo = new FlashObject(swfurl,"stylerow_<?php echo $rank_rowid?>","600","180","8","#FFFFFF");
	fo.addVariable("path", "<?php echo $rank_path?>");
	fo.addVariable("link", '<?php echo $rank_link?>');
	fo.addVariable("rank_hot" , "<?php echo $rank_hot?>");
	fo.write("flash_stylerow_<?php echo $rank_rowid?>");
</script>


