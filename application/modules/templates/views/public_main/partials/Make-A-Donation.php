
<style>

/* make a donation */
#message{
	text-align:justify;
}

#blue-line{
	font-size: 14pt;
	font-weight:bold;
	padding: 15px;
	color: #fff;
	text-align:center;
	background-color:#000066;
	/*height: 25px;*/
	width:100%;
}

.style2{
	font-size: 10pt;
	font-family: Verdana, helvetica, sans-serif;
	font-weight: bold;
	text-align: left;
	color: red;
	width: 100%;
	margin: 0 auto;
	padding: 15px 5px;
}


* {
    box-sizing: border-box;
}

/* Create three columns of equal width */
.columns {
    float: left;
    width: 100%;
    padding: 8px;
}

/* Style the list */
.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header {
    background-color: #111;
    color: white;
    font-size: 18px;
}

/* List items */
.price li {
    border-bottom: 1px solid #eee;
    padding: 0px;
    text-align: center;
}

/* Grey list item */
.price .grey {
    background-color: #eee;
    font-size: 16px;
}


</style>


<div class="col-md-6" >
		<p><b>Make a Donation: New Jersey Law Enforcement Police Officers Brotherhood Donation & Drive Safe Program</b></p>
		<img class="img-responsive"
			 src="<?= base_url() ?>public/images/donate/2017_NJLEPOB_Card.jpg" >
			 
		<p>Since the New Jersey Law Enforcement Police Officers Brotherhood is a Non-Profit
		organization that supports all Law Enforcement Officers &
		victims of crimes throughout the state of New Jersey we are
		compelled to reach out to the local community and residents
		within the state. Your donation and support of this Safety
		Driving Program will help reinforce our message to the men
		& women in uniform, who serve and protect, that their efforts
		are not forgotten and greatly appreciated.</p>

		<p>Based on your donation & level of commitment we have different
		supporter packages listed below. What level is good for you?
		Please check off one of the boxes below that indicated your
		Sponsorship commitment & submit it on the web or place it
		in the mail today. Once we receive your donation you will
		receive the following Articles or Packets under your sponsorship
		category. This is a wonderful opportunity for residents throughout
		the state to display our decals & articles identifying you
		as a friend and supporter of law enforcement. Thank you and
		be safe. If there are any questions, call <b>973-256-7390</b>.</p>
		<br><br>
</div>

<div class="col-md-6" >
		<div class="row">
			<div class="columns">
			  <ul class="price" >
			    <li class="header" style="background-color:#999999;">Platinum Sponsor</li>
			    <li class="grey">$ 125.00</li>
			    <li>1 New Jersey Law Enforcement POB Driving Safety card</li>
			    <li>1-Insurance Card Holder</li>
			    <li>1-Decal / Sticker</li>
			    <li>1-Community Supporter Card & 1-Mini Supporter - Badge</li>
			  </ul>
			  <ul class="price">
			    <li class="header" style="background-color:#FFCC00;">Gold Sponsor</li>
			    <li class="grey">$ 100.00</li>
			    <li>1 New Jersey Law Enforcement POB Driving Safety card</li>
			    <li>1-Decal / Sticker</li>
			    <li>1-Community Supporter Card & 1-Lapel Pin</li>
			  </ul>
			  <ul class="price">
			    <li class="header" style="background-color:#CCCCCC;">Silver Sponsor</li>
			    <li class="grey">$ 75.00</li>
			    <li>1 New Jersey Law Enforcement POB Driving Safety card</li>
			    <li>1-Decal / Sticker</li>
			    <li>1-Community Supporter Card</li>
			  </ul>
			  <ul class="price">
			    <li class="header" style="background-color:#AA8F6C;">Bronze</li>
			    <li class="grey">$ 50.00</li>
			    <li>1-Decal / Sticker & 1-Community Supporter Card</li>
			    <li>&nbsp;</li>
			    <li>&nbsp;</li>
			  </ul>
			  <ul class="price">
			    <li class="header" style="background-color:#3399FF;">Supporter</li>
			    <li class="grey">$ 25.00</li>
			    <li>1-Decal / Sticker</li>
			    <li>&nbsp;</li>
			    <li>&nbsp;</li>
			  </ul>
			</div>
		</div>

		<!-- "https://www.paypal.com/cgi-bin/webscr" -->
		<div class="row" style="text-align: center; padding: 10px 5px 20px 0px;">
			<form name="form1"
				  action="https://www.paypal.com/cgi-bin/webscr"
				  method="post"
				  onSubmit="return validate_donor();">

				<input type="hidden" name="Donor_type" value="">
				<input type="hidden" name="PrvPage" value="/donor-page.php" >
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="">

				<span >Sponsor Level: </span>
				<select name="sel_level" id="sel_level">
				   <option value='Select' >Select</option>
				   <option value='platinum_donor' >Platinum Sponsor</option>
				   <option value='gold_donor' >Gold Sponsor</option>
				   <option value='silver_donor' >Silver Sponsor</option>
				   <option value='bronz_donor' >Bronze Sponsor</option>
				   <option value='supporter' >Supporter</option>
				</select>
				<br><br>
				   <input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"  >
				   <img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
</div>

<div class="col-md-12" id="message" >
<!-- <div id="message"> -->
 <p>If you have any questions, concerns, need additional information
	or interested in becoming an Associate Member of our organization
	please go to the appropriate page on our website <span style="color: red;">WWW.NJLEPOB.COM</span>
	or call. We can be reached at 1-866-9NJ-LEPB. The New Jersey Law Enforcement Police Officers Brotherhood
	is registered with the NJ State Attorney General's office
	under this Charity registration # CH2885300 & Tax ID # 20-5715872. <b>Registration with the attorney general does not imply endorsement.</b></p>

 <p>For those who are not donating online print this page and take a moment to send in your check to 195 Paterson Ave. Suite #6, Little Falls, NJ 07424. Make check payable to New Jersey Law Enforcement.
	Every dollar really does make a difference!</p>

	<div class="style2" >The NJLEPOB is an Independent Law Enforcement Charitable Organization governed by Law Enforcement Officers active and retired, working with family members of Law Enforcement Officers during thier time of need or crises.
	<p id="blue-line">Together we can make the Thin Blue Line stronger!</p>
	</div>

</div>
