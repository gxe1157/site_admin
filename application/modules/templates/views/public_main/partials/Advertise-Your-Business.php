
<style>

.donorButton{
    font-size: 18px;
    text-align: center;
    color: #000;
    /*margin-top:10px;*/
    padding: 15px 5px;
    /*height:105px;*/
}

</style>

    <div class="col-sm-12" style="text-align:justify">
        <h2>Ad Form for Business Directory & Buyers Guide</h2>
           	Dear Friend of Law Enforcement,<br /><br />
            <p>On behalf of the New Jersey Law Enforcement Police Officers Brotherhood I would like to take this opportunity to thank
            you for your recent interest in taking an ad in our <b>BUSINESS
            DIRECTORY & BUYERS GUIDE</b> This directory & guide will be disseminated
            to all of our members as well as given out at our organizational
            events. We ask all our members & supporters to patronize the
            businesses in our book. The New Jersey Law Enforcement Police Officers Brotherhood is a non-profit organization
            and our membership is comprised of active and retired Law
            Enforcement Officers throughout the state of New Jersey as
            well as concerned citizens like your self. The New Jersey Law Enforcement Police Officers Brotherhood stands
            up for the rights of all law enforcement officers, NJ Citizens
            and the victims of crimes by supporting tough anti-crime legislation
            and policies that protect law enforcement officers while making
            your community and neighbourhood a safer place to live. Your
            generous donation or AD will enable us to make a strong presence
            at our states capitol in Trenton by writing our Legislators, and give us a more direct
            line to the policy makers in Washington, D.C. in support of all law enforcement issues.</p>
    </div>
    <div class="clear"></div>

    <!-- left Div -->
	<div class="col-sm-6">
                <h3>Your Support will help us with our:</h3>
				<ul>
				  <li>Bullet Proof Vest & Protective Equipment Fund</li>
				  <li>Death Benefits to families of officers killed in the line of duty</li>
				  <li>Financial Aid for Victims of crimes</li>
				  <li>Organizational Operations</li>
				  <li>Good & Welfare Fund</li>
				  <li>Scholarship Program in Memory of Deceased Law Enforcement Officers</li>
				  <li>Youth Organization Programs: *PAL*&nbsp;&nbsp;&nbsp;*DARE*</li>
				</ul>

              <p>If you have any questions, concerns, need additional information
                or interested in becoming an Associate Member of our organization
                please feel free to call us at 1-866-9NJ-LEPB. The New Jersey Law Enforcement Police Officers Brotherhood
                is registered with the NJ State Attorney General's office
                under this Charity registration# CH2885300 & Tax ID # 20-5715872. <strong>Registration with the Attorney General does not imply
                endorsement.</strong></p>
              <p>Once we receive your donation & Ad, our official supporter
                decal or package will be sent to you. This is a wonderful
                opportunity for residents throughout the state to say "Thank
                You" to the men and women in uniform who serve and protect
                the public that their efforts are not forgotten and greatly
                appreciated with your display of our supporter decal. Thanks
                again on behalf of all the New Jersey Law Enforcement Police Officers Brotherhood
                members.</p>
              <p>P.S. Please take a moment to send in your AD and check to
                195 Paterson Ave. Suite #6, Little Falls, NJ 07424 Every dollar really does
                make a difference! "Thank You". </p>

    </div>

    <div class="col-sm-5">
         <center>
         <img class="img-responsive" src="<?= base_url() ?>public/images/donate/ad_form.gif"
                 width="283"
                 height="300" border="0"/>
         </center>       

         <div class="donorButton">
              <form name="form1" action="<?= base_url() ?>msite_buy_ads/ad_form"
                    method="post"
                    onSubmit="return validate_adPage();">

                <input type="hidden" name="Payment_type" value="Buy Ads" >
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="">

                <span style="font-size:12pt; font-weight: bold;">Sponsor Level: </span>
                <select name="sel_level" id="sel_level">
                   <option value="Select" >Select</option>
                   <?php
                   foreach ($ad_plans as $key => $value) {
                        echo  '<option value="'. url_title( $value->ad_plan ).'" >'.$value->ad_plan.'</option>';
                   }
                   ?>
                </select>
                <br /><br />
                <input type="image"
                       src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
                       border="0"
                       alt="PayPal - The safer, easier way to pay online!">

                <img alt=""
                     border="0"
                     src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif"
                     width="1" height="1">
              </form>
         </div>
    </div>

