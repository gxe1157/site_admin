<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
    <?php if( ENVIRONMENT == 'development'){ echo '<div style="display: block; height: 5px; background: red;">&nbsp;</div>';} ?>
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle "
                   data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">

          <ul class="nav navbar-nav">
              <?php
                foreach ($parent_titles as $parentid => $sub_title) {
                  if( is_array($sub_title) ) {
                      echo '<li class="dropdown">';
                      echo '<a href="'.$target_url_start.$sub_title[0]->link.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                      echo $parentid.'<span class="caret"></span></a>';

                      /* subtiltes*/
                      if($sub_title){
                        echo '<ul class="dropdown-menu">';
                           foreach( $sub_title as $line ) {
                             $link_url = $line->link;
                             echo '<li><a href="'.$target_url_start.$link_url.'">'.$line->title.'</a></li>';
                           }
                        echo '</ul>';
                      }

                      echo '</li>';
                  } else {
                      echo '<li><a href="'.$target_url_start.$sub_title.'">'.$parentid.'
                      </a></li>';
                  } 
              }
            ?>
          </ul>

          <?php

          $this->load->module('site_security');
          $status = $this->site_security->_make_sure_logged_in();
          if( $status ) {
             echo '<ul class="nav navbar-nav navbar-right">
                      <li><a href="'.base_url().'youraccount/login">
                      <span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                   </ul>';
            } else {          
              echo '<ul class="nav navbar-nav navbar-right">            
                      <li><a href="'.base_url().'youraccount/logout">
                      <span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
                    </ul>';
            }

          ?>
        </div>
    </nav>
    </div>
