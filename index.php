<?php
/* -*- coding: utf-8 -*-
 * Copyright 2024-2025 SUSE LLC
 * Copyright 2015 Okta, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require('../simplesamlphp/src/_autoload.php');
session_start();

$title = 'SimpleSAMLphp Example SAML SP';
$user_session_key = 'user_session';
$saml_sso = 'saml_sso';

// If the user is logged in and requesting a logout.
if (isset($_REQUEST['logout'])) {
   $sp = $_REQUEST[$saml_sso];
   $as = new \SimpleSAML\Auth\Simple($sp);
   $as->logout(["ReturnTo" => $_SERVER['PHP_SELF']]);
   error_log(print_r("logout", TRUE));
}

// If the user is logging in.
if (isset($_REQUEST[$saml_sso])) {
    $sp = $_REQUEST[$saml_sso];
    error_log(print_r($sp, TRUE));
    $as = new \SimpleSAML\Auth\Simple($sp);
    $as->requireAuth();
    $user = array(
        'sp'         => $sp,
        'authed'     => $as->isAuthenticated(),
        'idp'        => $as->getAuthData('saml:sp:IdP'),
        'attributes' => $as->getAttributes(),
    );
    
    $_SESSION[$user_session_key] = $user;
}

?>  
<!DOCTYPE html>
<html>
  <head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://www.suse.com/assets/css/boxes-styles.css" type="text/css"/>
    <style>
.navbar {
  height: 3em;
  padding: 0;
  color: white;
  background-color: #0c322c;
}

.navbar-brand {
  margin-left: 1em;
  padding-top: 5px;
}

.navbar-text {
  position: absolute;
  right: 0;
  margin-right: 10px;
  margin-top: 10px;
}

.navbar-end-line {
  display: flex;
  height: 8px;
  flex-direction: row;
  flex-wrap: nowrap;
  z-index: 1031; }

.header-end-line-persimmon {
  background-color: #FE7C3F;
  width: 25%; }

.header-end-line-green {
  background-color: #30BA78;
  width: 45%; }

.header-end-line-waterhole-blue {
  background-color: #2453ff;
  width: 10%; }

.header-end-line-mint {
  background-color: #90ebcd;
  width: 20%; }

.content {
  margin-top: 10px;
  margin-left: 3em;
}

body h1 {
  margin-bottom: 0.3em;
}

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin:0;
  padding:0;
  width: 100%;
}

.logout {
  margin-top: 1em;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-Thin.woff2");
  font-weight: 200;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-Light.woff2");
  font-weight: 300;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-Regular.woff2");
  font-weight: 400;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-Medium.woff2");
  font-weight: 500;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-SemiBold.woff2");
  font-weight: 600;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-Bold.woff2");
  font-weight: 700;
}

@font-face {
  font-family: "SUSE";
  src:url("fonts/SUSE-ExtraBold.woff2");
  font-weight: 800;
}
    </style>
  </head>
  <body>
    <!-- BEGIN top bar -->
    <nav class="navbar">
      <div>
	<div class="navbar-text">
          Dummy web application
	</div>
	<div class="navbar-brand">
          <a href="#">
            <img alt="SUSE Logo" src="https://static.scc.suse.com/assets/suse-white-logo-green-9f0302c0fa1761b18a9779355da14916d6d37208ac95ad4db2856f73b71aa8c7.svg">
          </a>
	</div>
      </div>
    </nav>
    <div class="navbar-end-line">
      <div class="header-end-line-persimmon"></div>
      <div class="header-end-line-green"></div>
      <div class="header-end-line-waterhole-blue"></div>
      <div class="header-end-line-mint"></div>
    </div>
    <!-- END top bar -->

    <div class="content">
    <?php if(isset($_SESSION[$user_session_key])) { ?>
      <h1>Logged in</h1>
      <p >Contents of the most recent SAML assertion:</p>
      <div>
        <table>
	<?php foreach($_SESSION[$user_session_key]['attributes'] as $key => $value) { ?>
          <tr>
            <td><?= $key ?></td>
            <td><?= $value[0] ?></td>
          </tr>
	<?php } ?>
        </table>
      </div>
    <?php
      } else {
    ?>
      <h1>Not logged in</h1>
      <p>
        <a href="?saml_sso=example-ldap">Log in</a>
      </p>
    <?php } ?>
    <?php if(isset($_SESSION[$user_session_key])) { ?>
    <div class="logout">
      <a href="?saml_sso=<?= $_SESSION[$user_session_key]['sp'] ?>&logout=true">Logout</a>
    </div>
    <?php } ?>
    </div>
  </body>
</html>
