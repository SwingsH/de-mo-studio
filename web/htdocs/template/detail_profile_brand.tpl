<LINK REL="stylesheet" href="css/page_style.css" TYPE="text/css">


<table width="343" height="186" border="0" cellpadding="0">
  <tr>
    <td width="339" height="27" background="template/images/accer_top.gif">&nbsp;</td>
  </tr>
  <tr>
    <td height="55" background="templete/image/accent_center"><table width="333" border="0" cellspacing="0" cellpadding="0">
      <?php foreach($brands as $brand): ?>
      <tr>
        <td width="4" bgcolor="#EDEDED">&nbsp;</td>
        <td width="33" bgcolor="#EDEDED"><left><img src=<?=$brand['image']?> /></left></td>
        <td width="306" background="template/images/accer_center.gif" bgcolor="#FFFFFF"><div align="justify">
            <table width="294" border="0" align="left" cellpadding="0" bordercolor="#EDEDED">
              <tr>
                <td colspan="5" bordercolor="#FFFFFF" bgcolor="#EDEDED"><b> -<span class="stl_brand_ct">
                  <?=$brand['type']?>
                </span>-</b></td>
              </tr>
              <tr align="center" bordercolor="#FFFFFF" bgcolor="#EDEDED">
                <td width="9">&nbsp;</td>
                <td width="65" align="left"> <span class="stl_brand_ct">
                  <?=$brand['name']?>
                  </span>
                    <div align="center"></div></td>
                <td width="86"> <span class="stl_brand_ct">
                  <?=$brand['price']?>
                  </span>
                    <div align="center"></div></td>
                <td width="124" colspan="2"> <span class="stl_brand_ct">
                  <?=$brand['place']?>
                  <span>
                  <div align="center"></div>
                </span></span></td>
              </tr>
            </table>
        </div></td>
      </tr>
      <?php endforeach; ?>
      
    </table>    </td>
  </tr>
  <tr>
    <td height="96" background="template/images/accer_bottom.jpg">
	<table width="250" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td><br/><div style="margin-top: 0; margin-bottom: 0;" id="flashvote"></div> </td>
  </tr>
</table>
</td>

  </tr>
 
</table>
<script type="text/javascript" language="javascript">
	var swfurl="swf/detail_vote_v2.swf";
	var fob = new FlashObject(swfurl,"myvote","388","122","7","#FFFFFF");
	fob.addParam("wmode", "transparent");
	fob.addVariable("number","<?=$profile_vote?>");
	fob.addVariable("voted","<?=$voted?>");
	fob.addVariable("did","<?=$vote_did?>");
	fob.write("flashvote");
</script> 
