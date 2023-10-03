<p>DEMO很高興為您服務，您的需求我們將會盡快回覆！ </p>


        <SCRIPT LANGUAGE="JavaScript">
  
    function validate()
    {
        formObj = document.contact;
        if ((formObj.name.value == "") ||
            (formObj.email.value  == "") ||
            (formObj.subject.value  == "") ||
            (formObj.msg.value  == "")) 
        {
            alert("您沒有填寫完全！");
            return false;
        }
        else
            return true;
    }

  </SCRIPT>
  <form action=admin_mail.php method=post name=contact onSubmit="return validate()">
        <TABLE width="568" BORDER=0 align="center" cellpadding=0 cellspacing=0>
          <TR>
            <TD width="601" valign="top"> <BR>
                 <DIV> 您的稱呼
                    <input type=text size=50 maxlength=50 name=name class='text1xs'>
                    <p>
              連絡信箱
              <input name='email' type='text' class='text1xs'onclick="this.value=''" value="請輸入您的電子信箱" size='50' maxlength='60'>
              <p>
              連絡電話
              <input name='phone' type='text' class='text1xs' size='50' maxlength='32' onclick="this.value=''">
              <p>
              服務事項
              <select name='who'>
                <option value="1">問題提問</option>
                <option value="2">合作提案</option>
                <option value="3">公益服務</option>
                <option value="4">廣告刊登</option>
              </select>
              <p>
              信件標題
              <input name='subject' type='text' value="請務必填寫" size='50' maxlength='60'onclick="this.value=''">
                <p> 信件內容
                  <textarea name='msg' rows='7' cols='50' onClick="this.value=''">請詳細填寫服務事項</textarea>
                <p> 　　　　
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="按鈕" type='submit' value='寄 出'>
              <input type="reset" name="Submit" value="重 設">
              <p>
              </DIV></TD>
          </tR>
      </tABLE>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
