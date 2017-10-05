<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<style>

.profile-usermenu ul li {
  border-bottom: 0px solid #999;
}

.profile-usermenu ul li:last-child {
//  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #000;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

/*.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #000;
  margin-left: -2px;
}*/

</style>

<div class="col-sm-2" style="padding: 0px; min-height: 450px;">
    <!--  -->
    <div class="profile-sidebar">
      <!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
      <ul class="nav">
        <li>
          <a href="<?= base_url() ?>Make-a-Donation">Make a Donation</a>
        </li>
        <li>
          <a href="<?= base_url() ?>Advertise-Your-Business">Advertise Your Business</a>
        </li>
        <li>
          <a href="<?= base_url() ?>Become-A-Member">Become A Member</a>
        </li>
      </ul>
    </div>
    <!-- END MENU -->
    </div>
    <!--  -->
</div>
