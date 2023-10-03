<?php foreach($profile_rows as $profile_row): ?>
<?php echo $profile_row->fetch()?>
<?php endforeach; ?>

<DIV align="center" id="block_page">
<table border="0" cellpadding="0" cellspacing="0" id="tb_page">
  <tr>
     <td width="40" align="center" bgcolor="#FFFFFF">
    <span class="page_switch" >頁面</span>
    </td>
    <td bgcolor="#b4b4b4">
    <table border="0" cellpadding="0" cellspacing="1" id="table6">
      <tr align="center">

      <?php foreach( $urls as $url ): ?>
       <td width="25" align="center" bgcolor="#FFFFFF">
      <? echo (++$page!=$curren_page)?"<a href=\"".$url."\" target=\"_self\" >" : ""?>

      <span class="page_switch_number"><?=$page?></span>
      
      </a>
       </td>
       <?php endforeach; ?>
       
       </tr>
    </table></td>
  </tr>
</table>
</DIV id="block_page">