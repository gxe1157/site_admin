<style>
  .capbox {
    background-color: #117A65;
    /*border: #B3E272 0px solid;*/
    /*border: #000 1px solid;    */
    text-align:center;    
    border-width: 0px 12px 0px 0px;
    width: 350px;
    display: inline-block;
    *display: inline; zoom: 1; /* FOR IE7-8 */
    padding: 8px 20px 8px 20px;
    }

  .capbox-inner {
    font: bold 14px arial, sans-serif;
    text-align:center;
    color: #000000;
    background-color: #EEE;
    margin: 5px auto 0px auto;
    padding: 3px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    }

  #CaptchaDiv {
    font: bold 17px verdana, arial, sans-serif;
    font-style: italic;
    color: #000000;
    background-color: #FFFFFF;
    padding: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    }

  #CaptchaInput { margin: 1px 0px 1px 0px; height: 30px; width: 135px; }

</style>

<div style="color: red; text-align: center;">
   <?= $captcha_isValid == false ? "The captcha characters are required." : null ?>
</div>

<div class="form-group">
  <label class="control-label col-sm-4""></label>
  <div class="col-sm-8">
    <!-- START CAPTCHA -->
    <div class="capbox">

    <div id="CaptchaDiv"><?= $captcha_html ?></div>

    <div class="capbox-inner">
    Type the above characters:<br>
    <input type="text" name="captcha"
           id="captcha" size="15">
    <br>

    </div>
    </div>
    <br><br>
    <!-- END CAPTCHA -->          
  </div>
</div>
