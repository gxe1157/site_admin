
<div class="col-md-12" style="margin-top:20px;">
    <div class="col-md-5">
         <img class="image img-responsive img-thumbnail" src="<?= base_url() ?>public/images/Law_enforcement/1-2T.jpg" width="80%" />

    </div>

    <div class="col-md-7">
        <div class="pricing-table">
            <div class="panel panel-primary" style="border: none;">

                <div class="controle-header panel-heading panel-heading-landing">
                    <h3 class="panel-title panel-title-landing">
                        Law Enforcement Officer
                    </h3>
                </div>
                <div class="panel-body panel-body-landing">
                     <table class="table" style="min-height: 210px;">
                         <tr>
                            <td  style="font-size: 1.5em; text-align:center; color: red; ">
                              Annual Fee: $35.00
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <ul class="panel_ul">                                     
                                    <li>Preferred Vendor Program/Law Enforcement Buy*</li>
                                    <li>Free Legal Consultation / Legal Services Network*<br />Medical /Dental Services <span class="panel_li_spans">( Physicians Committee )</span>*</li>
                                    <li>Financial Services Network <span class="panel_li_spans">( Planning & Accountants )</span>*</li>
                                    <li>Insurance Services Network <span class="panel_li_spans">( Life, Home, Vehicle, etc. )</span>*</li>
                                    <li>Membership Credentials & Certificate,</li>
                                    <li>20- POB Courtesy Cards</li>
                                    <li>Member Car Shield*</li>
                                    <li>Auto Decal, Membership Lapel Pin & Calendar*</li>
                                    <li>Copy of News letter</li>                                    
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-footer panel-footer-landing">
                  <div class="row clearfix">
                    <div class ="col-sm-12" style="margin: 0 auto; text-align:center; ">

                    <form class="form-inline" role="form"
                          action="<?= base_url() ?>users_registration"
                          method="POST"
                          onSubmit=" return validate()" >

                       <div class="form-group">
                          <label for="LE-Membership" >Membership level 
                          <select class="form-control" name="selected_plan" id="selected_plan" >
                              <option value='0' >Select</option>
                              <option value='LE_Active' >Active</option>
                              <option value='LE_Retired-Form' >Retired\Former</option>
                          </select>
                          </label>
                       </div>
                       <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                   </div> 
                   </div>
                   <div id="error-mess"></div>                   
                </div>

            </div>
        </div>

       <p style="padding: 5px; text-align:justify;">If you are not comfortable applying or making payments on-line, Click on the Download App link below, fill out the application, print it out, enclose a check and send it us ASAP.<br /> Thank You!</p>
        <div style="cursor:pointer;" ><a onClick="Javascript: do_post();">
        <img class="image img-responsive center-block" src="<?= base_url() ?>public//images/Become A Member Section-4.png" width="300" height="45" /></a></div>

    </div>

    <div style="clear:both;"></div> 
  
    <div class="col-md-12">
      <section>
      <h3>Eligibility</h3>

      <p>
      <b>(1) Any Regularly Appointed or Elected Law Enforcement Officer /Official Active or Retired</b> of these United States, or any State, political subdivision thereof, for any agency who is
       <span style="font-weight: bold; text-decoration:underline;">sworn to up hold the law</span> shall be eligible for membership in the Organization, subject to provisions set forth in the Constitution and By-Laws of this Organization. No person shall be denied membership on account of race, religion, sex, age, creed, color or national origin.<br/><br/>
      <b>(2) The Active, Former & Retired Membership</b> shall be comprised of regularly appointed or elected Law Enforcement Officers/Officials sworn to up hold the law of the United States or any of the States or political subdivisions. This class may include, subject to the approval of the Executive Board, those members who formerly served as a law enforcement officer for more than one (1) year.<span style="background: yellow;"> The yearly membership dues shall be ($35.00) or ($90.00) for 3 years savings of $15.00.</span> Said fee may be waived by vote of the Executive Board. All members in good standing active, former & retired, (as herein defined), and those members assigned to positions with titles of Director and/or committee chairman, shall have voice and right to vote on all issues. </p>
      <br>
      <p style="color:red;">Based on our Benefit Packet that you will receive from us, 75% of your dues are spent on benefit materials and administrative cost of sending you your membership articles. Therefore the organization doesn't make money on Law Enforcement Officers. We make it on our fundraising programs and on our <span style="font-weight: bold; text-decoration:underline;">Civilian Associate Membership Programs!</span></p>
      <br>
      <p style=" font-size: 11pt; background-color: yellow; padding: 10px 25px;  color: #000;" >
      <span style="font-size: 11pt; font-weight: bold; color: red; margin-left: 3px; margin-top: 5px; ">Please Note:</span><br />This organization is governed by active & retired / former Law Enforcement officers. Therefore the activities and decisions of the organization are made only by law enforcement officers. Civilians have a right to voice their concerns as associated members but do not have voting powers!</p>
      </section>
    </div>

</div>

<script>

function validate() {

  if( document.getElementById('selected_plan').value == 0 ){
      //alert('Please select a Membership level then click the Register button.');
      document.getElementById("error-mess").innerHTML ='<span style="display:block; text-align: center; padding: 10px; color:red; font-weight: bold">Select a Membership level then<br>click the Register button.</span>';

      return false
  }

}

</script>
