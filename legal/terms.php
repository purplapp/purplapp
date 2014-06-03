<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);   

	$title = "Terms of Use - Purplapp"; 

	require_once '../ADN_php/EZAppDotNet.php';
	$app = new EZAppDotNet();

	if ($app->getSession()) {
		include('../include/header_auth.php');
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>PURPLAPP TERMS OF SERVICE <small> Last Updated: May 2014</small></h1>
	</div>

	<p>These terms of service (&#8220;Terms&#8221;) apply to your access and use of PURPLAPP (the &#8220;Service&#8221;). Please read them carefully.</p>

	<h2>Accepting these Terms</h2>

	<p>If you access or use the Service, it means you agree to be bound by all of the terms below. So, before you use the Service, please read all of the terms. If you don't agree to all of the terms below, please do not use the Service. Also, if a term does not make sense to you, please let us know by e-mailing <strong>support@jvimedia.org</strong>.</p>

	<h2>Changes to these Terms</h2>

	<p>We reserve the right to modify these Terms at any time. For instance, we may need to change these Terms if we come out with a new feature or for some other reason.</p>

	<p>Whenever we make changes to these Terms, the changes are effective <strong>immediately</strong> after we post such revised Terms (indicated by revising the date at the top of these Terms) or upon your acceptance if we provide a mechanism for your immediate acceptance of the revised Terms (such as a click-through confirmation or acceptance button). It is your responsibility to check PURPLAPP for changes to these Terms.</p>

	<p>If you continue to use the Service after the revised Terms go into effect, then you have accepted the changes to these Terms.</p>

	<h2>Privacy Policy</h2>

	<p>For information about how we collect and use information about users of the Service, please check out our privacy policy available at <strong><a href="privacy.php">PURPLAPP.eu/legal/privacy.php</a></strong>.</p>

	<h2>Third-Party Services</h2>

	<p>From time to time, we may provide you with links to third party websites or services that we do not own or control. Your use of the Service may also include the use of applications that are developed or owned by a third party. Your use of such third party applications, websites, and services is governed by that party&#8217;s own terms of service or privacy policies. We encourage you to read the terms and conditions and privacy policy of any third party application, website or service that you visit or use.</p>

	<h2>Creating Accounts</h2>

	<p>When you create an account or use another service to log in to the Service, you agree to maintain the security of your password and accept all risks of unauthorized access to any data or other information you provide to the Service.</p>

	<p>If you discover or suspect any Service security breaches, please let us know as soon as possible.</p>

	<h2>Your Content &amp; Conduct</h2>

	<p>Our Service allows you and other users to post, link and otherwise make available content. You are responsible for the content that you make available to the Service, including its legality, reliability, and appropriateness.</p>

	<p>When you post, link or otherwise make available content to the Service, you grant us the right and license to use, reproduce, modify, publicly perform, publicly display and distribute your content on or through the Service. We may format your content for display throughout the Service, but we will not edit or revise the substance of your content itself.</p>

	<p>Aside from our limited right to your content, you retain all of your rights to the content you post, link and otherwise make available on or through the Service.</p>

	<h2>PURPLAPP Materials</h2>

	<p>We put a lot of effort into creating the Service including, the logo and all designs, text, graphics, pictures, information and other content (excluding your content). This property is owned by us or our licensors and it is protected by U.S. and international copyright laws. We grant you the right to use it.</p>

	<p>However, unless we expressly state otherwise, your rights do not include: (i) publicly performing or publicly displaying the Service; (ii) modifying or otherwise making any derivative uses of the Service or any portion thereof; (iii) using any data mining, robots or similar data gathering or extraction methods; (iv) downloading (other than page caching) of any portion of the Service or any information contained therein; (v) reverse engineering or accessing the Service in order to build a competitive product or service; or (vi) using the Service other than for its intended purposes. If you do any of this stuff, we may terminate your use of the Service.</p>

	<h2>Hyperlinks and Third Party Content</h2>

	<p>You may create a hyperlink to the Service. But, you may not use, frame or utilize framing techniques to enclose any of our trademarks, logos or other proprietary information without our express written consent.</p>

	<p>PURPLAPP makes no claim or representation regarding, and accepts no responsibility for third party websites accessible by hyperlink from the Service or websites linking to the Service. When you leave the Service, you should be aware that these Terms and our policies no longer govern.</p>

	<p>If there is any content on the Service from you and others, we don&#8217;t review, verify or authenticate it, and it may include inaccuracies or false information. We make no representations, warranties, or guarantees relating to the quality, suitability, truth, accuracy or completeness of any content contained in the Service. You acknowledge sole responsibility for and assume all risk arising from your use of or reliance on any content.</p>

	<h2>Unavoidable Legal Stuff</h2>

	<p>THE SERVICE AND ANY OTHER SERVICE AND CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE ARE PROVIDED TO YOU ON AN AS IS OR AS AVAILABLE BASIS WITHOUT ANY REPRESENTATIONS OR WARRANTIES OF ANY KIND. WE DISCLAIM ANY AND ALL WARRANTIES AND REPRESENTATIONS (EXPRESS OR IMPLIED, ORAL OR WRITTEN) WITH RESPECT TO THE SERVICE AND CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE WHETHER ALLEGED TO ARISE BY OPERATION OF LAW, BY REASON OF CUSTOM OR USAGE IN THE TRADE, BY COURSE OF DEALING OR OTHERWISE.</p>

	<p>IN NO EVENT WILL <strong>PURPLAPP</strong> BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY SPECIAL, INDIRECT, INCIDENTAL, EXEMPLARY OR CONSEQUENTIAL DAMAGES OF ANY KIND ARISING OUT OF OR IN CONNECTION WITH THE SERVICE OR ANY OTHER SERVICE AND/OR CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE, REGARDLESS OF THE FORM OF ACTION, WHETHER IN CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES OR ARE AWARE OF THE POSSIBILITY OF SUCH DAMAGES. OUR TOTAL LIABILITY FOR ALL CAUSES OF ACTION AND UNDER ALL THEORIES OF LIABILITY WILL BE LIMITED TO THE AMOUNT YOU PAID TO <strong>PURPLAPP</strong>. THIS SECTION WILL BE GIVEN FULL EFFECT EVEN IF ANY REMEDY SPECIFIED IN THIS AGREEMENT IS DEEMED TO HAVE FAILED OF ITS ESSENTIAL PURPOSE.</p>

	<p>You agree to defend, indemnify and hold us harmless from and against any and all costs, damages, liabilities, and expenses (including attorneys&#8217; fees, costs, penalties, interest and disbursements) we incur in relation to, arising from, or for the purpose of avoiding, any claim or demand from a third party relating to your use of the Service or the use of the Service by any person using your account, including any claim that your use of the Service violates any applicable law or regulation, or the rights of any third party, and/or your violation of these Terms.</p>

	<h2>Termination</h2>

	<p>If you breach any of these Terms, we have the right to suspend or disable your access to or use of the Service.</p>

	<h2>Entire Agreement</h2>

	<p>These Terms constitute the entire agreement between you and PURPLAPP regarding the use of the Service, superseding any prior agreements between you and PURPLAPP relating to your use of the Service.</p>

	<h2>Feedback</h2>

	<p>Please let us know what you think of the Service, these Terms and, in general, PURPLAPP. When you provide us with any feedback, comments or suggestions about the Service, these Terms and, in general, PURPLAPP, you irrevocably assign to us all of your right, title and interest in and to your feedback, comments and suggestions.</p>

	<h2>Questions &amp; Contact Information</h2>

	<p>Questions or comments about the Service may be directed to us at the email address <strong>support@jvimedia.org</strong>.</p>
</div>

<?php 
  } else {
    include('../include/header_unauth.php'); 
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>PURPLAPP TERMS OF SERVICE <small> Last Updated: May 2014</small></h1>
	</div>

	<p>These terms of service (&#8220;Terms&#8221;) apply to your access and use of PURPLAPP (the &#8220;Service&#8221;). Please read them carefully.</p>

	<h2>Accepting these Terms</h2>

	<p>If you access or use the Service, it means you agree to be bound by all of the terms below. So, before you use the Service, please read all of the terms. If you don't agree to all of the terms below, please do not use the Service. Also, if a term does not make sense to you, please let us know by e-mailing <strong>support@jvimedia.org</strong>.</p>

	<h2>Changes to these Terms</h2>

	<p>We reserve the right to modify these Terms at any time. For instance, we may need to change these Terms if we come out with a new feature or for some other reason.</p>

	<p>Whenever we make changes to these Terms, the changes are effective <strong>immediately</strong> after we post such revised Terms (indicated by revising the date at the top of these Terms) or upon your acceptance if we provide a mechanism for your immediate acceptance of the revised Terms (such as a click-through confirmation or acceptance button). It is your responsibility to check PURPLAPP for changes to these Terms.</p>

	<p>If you continue to use the Service after the revised Terms go into effect, then you have accepted the changes to these Terms.</p>

	<h2>Privacy Policy</h2>

	<p>For information about how we collect and use information about users of the Service, please check out our privacy policy available at <strong><a href="privacy.php">PURPLAPP.eu/legal/privacy.php</a></strong>.</p>

	<h2>Third-Party Services</h2>

	<p>From time to time, we may provide you with links to third party websites or services that we do not own or control. Your use of the Service may also include the use of applications that are developed or owned by a third party. Your use of such third party applications, websites, and services is governed by that party&#8217;s own terms of service or privacy policies. We encourage you to read the terms and conditions and privacy policy of any third party application, website or service that you visit or use.</p>

	<h2>Creating Accounts</h2>

	<p>When you create an account or use another service to log in to the Service, you agree to maintain the security of your password and accept all risks of unauthorized access to any data or other information you provide to the Service.</p>

	<p>If you discover or suspect any Service security breaches, please let us know as soon as possible.</p>

	<h2>Your Content &amp; Conduct</h2>

	<p>Our Service allows you and other users to post, link and otherwise make available content. You are responsible for the content that you make available to the Service, including its legality, reliability, and appropriateness.</p>

	<p>When you post, link or otherwise make available content to the Service, you grant us the right and license to use, reproduce, modify, publicly perform, publicly display and distribute your content on or through the Service. We may format your content for display throughout the Service, but we will not edit or revise the substance of your content itself.</p>

	<p>Aside from our limited right to your content, you retain all of your rights to the content you post, link and otherwise make available on or through the Service.</p>

	<h2>PURPLAPP Materials</h2>

	<p>We put a lot of effort into creating the Service including, the logo and all designs, text, graphics, pictures, information and other content (excluding your content). This property is owned by us or our licensors and it is protected by U.S. and international copyright laws. We grant you the right to use it.</p>

	<p>However, unless we expressly state otherwise, your rights do not include: (i) publicly performing or publicly displaying the Service; (ii) modifying or otherwise making any derivative uses of the Service or any portion thereof; (iii) using any data mining, robots or similar data gathering or extraction methods; (iv) downloading (other than page caching) of any portion of the Service or any information contained therein; (v) reverse engineering or accessing the Service in order to build a competitive product or service; or (vi) using the Service other than for its intended purposes. If you do any of this stuff, we may terminate your use of the Service.</p>

	<h2>Hyperlinks and Third Party Content</h2>

	<p>You may create a hyperlink to the Service. But, you may not use, frame or utilize framing techniques to enclose any of our trademarks, logos or other proprietary information without our express written consent.</p>

	<p>PURPLAPP makes no claim or representation regarding, and accepts no responsibility for third party websites accessible by hyperlink from the Service or websites linking to the Service. When you leave the Service, you should be aware that these Terms and our policies no longer govern.</p>

	<p>If there is any content on the Service from you and others, we don&#8217;t review, verify or authenticate it, and it may include inaccuracies or false information. We make no representations, warranties, or guarantees relating to the quality, suitability, truth, accuracy or completeness of any content contained in the Service. You acknowledge sole responsibility for and assume all risk arising from your use of or reliance on any content.</p>

	<h2>Unavoidable Legal Stuff</h2>

	<p>THE SERVICE AND ANY OTHER SERVICE AND CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE ARE PROVIDED TO YOU ON AN AS IS OR AS AVAILABLE BASIS WITHOUT ANY REPRESENTATIONS OR WARRANTIES OF ANY KIND. WE DISCLAIM ANY AND ALL WARRANTIES AND REPRESENTATIONS (EXPRESS OR IMPLIED, ORAL OR WRITTEN) WITH RESPECT TO THE SERVICE AND CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE WHETHER ALLEGED TO ARISE BY OPERATION OF LAW, BY REASON OF CUSTOM OR USAGE IN THE TRADE, BY COURSE OF DEALING OR OTHERWISE.</p>

	<p>IN NO EVENT WILL <strong>PURPLAPP</strong> BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY SPECIAL, INDIRECT, INCIDENTAL, EXEMPLARY OR CONSEQUENTIAL DAMAGES OF ANY KIND ARISING OUT OF OR IN CONNECTION WITH THE SERVICE OR ANY OTHER SERVICE AND/OR CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE, REGARDLESS OF THE FORM OF ACTION, WHETHER IN CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES OR ARE AWARE OF THE POSSIBILITY OF SUCH DAMAGES. OUR TOTAL LIABILITY FOR ALL CAUSES OF ACTION AND UNDER ALL THEORIES OF LIABILITY WILL BE LIMITED TO THE AMOUNT YOU PAID TO <strong>PURPLAPP</strong>. THIS SECTION WILL BE GIVEN FULL EFFECT EVEN IF ANY REMEDY SPECIFIED IN THIS AGREEMENT IS DEEMED TO HAVE FAILED OF ITS ESSENTIAL PURPOSE.</p>

	<p>You agree to defend, indemnify and hold us harmless from and against any and all costs, damages, liabilities, and expenses (including attorneys&#8217; fees, costs, penalties, interest and disbursements) we incur in relation to, arising from, or for the purpose of avoiding, any claim or demand from a third party relating to your use of the Service or the use of the Service by any person using your account, including any claim that your use of the Service violates any applicable law or regulation, or the rights of any third party, and/or your violation of these Terms.</p>

	<h2>Termination</h2>

	<p>If you breach any of these Terms, we have the right to suspend or disable your access to or use of the Service.</p>

	<h2>Entire Agreement</h2>

	<p>These Terms constitute the entire agreement between you and PURPLAPP regarding the use of the Service, superseding any prior agreements between you and PURPLAPP relating to your use of the Service.</p>

	<h2>Feedback</h2>

	<p>Please let us know what you think of the Service, these Terms and, in general, PURPLAPP. When you provide us with any feedback, comments or suggestions about the Service, these Terms and, in general, PURPLAPP, you irrevocably assign to us all of your right, title and interest in and to your feedback, comments and suggestions.</p>

	<h2>Questions &amp; Contact Information</h2>

	<p>Questions or comments about the Service may be directed to us at the email address <strong>support@jvimedia.org</strong>.</p>
</div>

<?php
  }
  include('../include/footer.php');
?>