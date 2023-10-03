
<LINK REL="stylesheet" href="css/style_detail.css" TYPE="text/css">


<div align="left">
	<table  border="0" width="770" id="main_table" cellspacing="0" cellpadding="0" >
		<tr>
			<td height="62" colspan="3" background="template/images/tb_3_top.gif"> 
			  <table width="300" border="0" id="for_pic_align">
                <tr>
                  <td><img src="<?=$profile_link?>" align="right"/></td>
                </tr>
              </table></td>
		</tr>
		<tr>
			<td width="11" background="template/images/tb_3_lmid.gif">
			　</td>
			<td width="748" align="center" valign="top">
			
              <table width="671" height="237" border="0" cellpadding="0" style="color: #0066CC" id="profile_table">
      
              <tbody style="color: #0066CC">
              
              <tr style="color: #0066CC">
                <td width="390" align="left" valign="top" style="color: #0066CC">
                <?=$detail_content?>
             
                <p><span class="stl_col_content">
                  評語：</span><br><span class="stl_col_content">
                  <?=$profile_evaluation?>
</span></p>
                <p><span class="stl_col_content">色系：</span><span class="stl_col_content"><?=$profile_color?>
                  </span></p>
                <p>&nbsp;</p></td>
                <td width="275" height="212" align="center" valign="top" bordercolor="#FFFFFF" style="color: #0066CC" >
                
                <div align="right" style="margin-top: 0; margin-bottom: 0; color:#0066CC" id="flashphoto"> 
                Here Will Insert Swf
					<table border="1" width="275" cellspacing="0" cellpadding="0" height="510" id="table4">
						<tr>
							<td>　</td>
						</tr>
					</table>
					Here Will Insert Swf</div>
					

		
                    <p><span class="stl_prodate"  bgcolor="#000000" >拍攝日期：</span> 
                    <span class="stl_prodate">
                      <?=$year?>
                      </span> /
                      <span class="stl_prodate">
                      <?=$month?>
                      </span>/<span class="stl_prodate">
                      <?=$day?>
                      </span>
					  <br/>
                     <span style="color:#000000 ; font-size:9pt ;">Demo 
					Model</span> 
					<span style="color: #FF0000 ; font-size:9pt ;">
					No.</span>
					<span class="stl_pronumber">
                      <?=$profile_number?>
                    </span> 
					</p>
                  <table width="271" border="0" cellpadding="2" cellspacing="2" bordercolor="#FCF5B4" bgcolor="#FCF5B4" style="color: #0066CC" id="table3">
                      <tbody style="color: #0066CC">
                      <tr valign="top" bordercolor="#FFCCCC" bgcolor="#FCF5B4" style="color: #0066CC">
                        <td width="115" style="color: #0066CC">
                        <span class="stl_col_name">
						綽號：
						</span>
						<span class="stl_col_content">
                          <?=$profile_name?>
                        </span></td>
                        <td width="142" style="color: #0066CC">
                        <span class="stl_col_name">
						年齡：
						</span>
						<span class="stl_col_content">
                          <?=$profile_age?>
                        </span>
                        </td>
                      </tr>
                      <tr valign="top" bordercolor="#FFCCCC" bgcolor="#FCF5B4" style="color: #0066CC">
                        <td style="color: #0066CC">
                        <span class="stl_col_name">身高：</span>
                        <span class="stl_col_content">
                          <?=$profile_tall?>
                        </span></td>
                        <td style="color: #0066CC"><span class="stl_col_name">地點：</span>
                        <span class="stl_col_content">
                          <?=$profile_location?>
                        </span></td>
                      </tr>
                      <tr valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC" style="color: #0066CC">
                        <td colspan="2" bordercolor="#FFCCCC" bgcolor="#FCF5B4" style="color: #0066CC">
                        <span class="stl_col_name">
						想說的一句話：</span>
						<br style="color: #0066CC"/>
                          &nbsp;&nbsp;&nbsp;
                          <span class="stl_col_content">
                          <?=$profile_say?>
                        </span></td>
                      </tr>
                  </table>
                </td>
              </tr>
              </table>
			
    </td>
			<td width="11" background="template/images/tb_3_rmid.gif">
			<img src="template/images/tb_3_rmid.gif"/>
			　</td>
		</tr>
		<tr>
			<td colspan="3">
			<img border="0" src="template/images/tb_3_bottom.gif" width="770" height="20"></td>
		</tr>
	</table>
</div>

		<script type="text/javascript" language="javascript">
			var swfurl="swf/detail_photo.swf";
			var fo = new FlashObject(swfurl,"myphoto","275","510","7","#FFFFFF");
			fo.addVariable("cache","<?=$imgcache?>");
			fo.addVariable("path","<?=$imgpath?>");
			fo.write("flashphoto");
		</script>