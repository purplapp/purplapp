<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);   

	$title = "Privacy Policy - Purplapp"; 

	require_once '../ADN_php/EZAppDotNet.php';
	$app = new EZAppDotNet();

	if ($app->getSession()) {
		include('../include/header_auth.php');
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>PURPLAPP PRIVACY POLICY <small> Last Updated: May 2014</small></h1>
	</div>

	<p>Our privacy policy applies to information we collect when you use or access our website, application, or just interact with us. We may change this privacy policy from time to time. Whenever we make changes to this privacy policy, the changes are effective 30 days after we post the revised privacy policy (as indicated by revising the date at the top of our privacy policy). We encourage you to review our privacy policy whenever you access our services to stay informed about our information practices and the ways you can help protect your privacy.</p>

	<h2>Collection of Information</h2>

	<h3>Information You Provide to Us</h3>

	<p>We collect information you provide directly to us. For example, we collect information when you participate in any interactive features of our services, fill out a form, request customer support, provide any contact or identifying information or otherwise communicate with us. The types of information we may collect include your name, email address, postal address, credit card information and other contact or identifying information you choose to provide.</p>

	<h3>Information We Collect Automatically When You Use the Services</h3>

	<p>When you access or use our services, we automatically collect information about you, including:</p>

	<ul>
	<li><strong>Log Information</strong>: We log information about your use of our services, including the type of browser you use, access times, pages viewed, your IP address and the page you visited before navigating to our services.</li>
	<li><strong>Device Information</strong>: We collect information about the computer you use to access our services, including the hardware model, and operating system and version.</li>
	<li><strong>Information Collected by Cookies and Other Tracking Technologies</strong>: We use various technologies to collect information, and this may include sending cookies to your computer. Cookies are small data files stored on your hard drive or in your device memory that helps us to improve our services and your experience, see which areas and features of our services are popular and count visits. We may also collect information using web beacons (also known as &#8220;tracking pixels&#8221;). Web beacons are electronic images that may be used in our services or emails and to track count visits or understand usage and campaign effectiveness.</li>
	</ul>

	<p>For more details about how we collect information, including details about cookies and how to disable them, please see &#8220;Your Information Choices&#8221; below.</p>

	<h3>Information We Collect From Other Sources</h3>

	<p>In order to provide you with access to the Service, or to provide you with better service in general, we may combine information obtained from other sources (for example, a third-party service whose application you have authorized or used to sign in) and combine that with information we collect through our services.</p>

	<h2>Use of Information</h2>

	<p>We use information about you for various purposes, including to:</p>

	<ul>
	<li>Provide, maintain and improve our services;</li>
	<li>Provide services you request, process transactions and to send you related information;</li>
	<li>Send you technical notices, updates, security alerts and support and administrative messages;</li>
	<li>Respond to your comments, questions and requests and provide customer service;</li>
	<li>Communicate with you about news and information related to our service;</li>
	<li>Monitor and analyze trends, usage and activities in connection with our services; and</li>
	<li>Personalize and improve our services.</li>
	</ul>

	<p>By accessing and using our services, you consent to the processing and transfer of your information in and to the United States and other countries.</p>

	<h2>Sharing of Information</h2>

	<p>We may share personal information about you as follows:</p>

	<ul>
	<li>If we believe disclosure is reasonably necessary to comply with any applicable law, regulation, legal process or governmental request;</li>
	<li>To enforce applicable user agreements or policies, including our Terms of Service <strong><a href="terms.php">http://revive.purplapp.eu/legal/terms.php</a></strong>, and to protect us, our users or the public from harm or illegal activities;</li>
	<li>In connection with any merger, sale of PURPLAPP assets, financing or acquisition of all or a portion of our business to another company; and</li>
	<li>If we notify you through our services (or in our privacy policy) that the information you provide will be shared in a particular manner and you provide such information.</li>
	</ul>

	<p>We may also share aggregated or anonymized information that does not directly identify you.</p>

	<h2>Third Party Analytics</h2>

	<p>We may allow third parties to provide analytics services. These third parties may use cookies, web beacons and other technologies to collect information about your use of the services and other websites, including your IP address, web browser, pages viewed, time spent on pages, links clicked and conversion information. This information may be used by us and third parties to, among other things, analyze and track data, determine the popularity of certain content and other websites and better understand your online activity. Our privacy policy does not apply to, and we are not responsible for, third party cookies, web beacons or other tracking technologies and we encourage you to check the privacy policies of these third parties to learn more about their privacy practices.</p>

	<h2>Security</h2>

	<p>We take reasonable measures to help protect personal information from loss, theft, misuse and unauthorized access, disclosure, alteration and destruction.</p>

	<h2>Your Information Choices</h2>

	<h3>Location Information</h3>

	<p>Purplapp collects no information data.</p>

	<h3>Cookies</h3>

	<p>Most web browsers are set to accept cookies by default. If you prefer, you can usually choose to set your browser to remove or reject browser cookies. Please note that if you choose to remove or reject cookies, this could affect the availability and functionality of our services.</p>

	<h3>Promotional Communications</h3>

	<p>You may opt out of receiving any promotional emails from us by following the instructions in those emails. If you opt out, we may still send you non-promotional communications, such as those about your account or our ongoing business relations.</p>

	<h3>Your California Privacy Rights</h3>

	<p>California law permits residents of California to request certain details about how their information is shared with third parties for direct marketing purposes. If you are a California resident and would like to make such a request, please contact us at <strong>support@purplapp.eu</strong>. However, please note that under the law, Services such as ours that permit California residents to opt in to, or opt out of, this type of sharing are not required to provide such information upon receiving a request, but rather may respond by notifying the user of his or her right to prevent the disclosure. To opt out of having information about you shared with third parties for direct marketing purposes, please contact support via <strong>support@purplapp.eu</strong></p>

	<h2>Contact Us</h2>

	<p>If you have any questions about this privacy policy, please contact us at: <strong>support@purplapp.eu</strong></p>
</div>

<?php 
  } else {
    include('../include/header_unauth.php'); 
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>PURPLAPP PRIVACY POLICY <small> Last Updated: May 2014</small></h1>
	</div>

	<p>Our privacy policy applies to information we collect when you use or access our website, application, or just interact with us. We may change this privacy policy from time to time. Whenever we make changes to this privacy policy, the changes are effective 30 days after we post the revised privacy policy (as indicated by revising the date at the top of our privacy policy). We encourage you to review our privacy policy whenever you access our services to stay informed about our information practices and the ways you can help protect your privacy.</p>

	<h2>Collection of Information</h2>

	<h3>Information You Provide to Us</h3>

	<p>We collect information you provide directly to us. For example, we collect information when you participate in any interactive features of our services, fill out a form, request customer support, provide any contact or identifying information or otherwise communicate with us. The types of information we may collect include your name, email address, postal address, credit card information and other contact or identifying information you choose to provide.</p>

	<h3>Information We Collect Automatically When You Use the Services</h3>

	<p>When you access or use our services, we automatically collect information about you, including:</p>

	<ul>
	<li><strong>Log Information</strong>: We log information about your use of our services, including the type of browser you use, access times, pages viewed, your IP address and the page you visited before navigating to our services.</li>
	<li><strong>Device Information</strong>: We collect information about the computer you use to access our services, including the hardware model, and operating system and version.</li>
	<li><strong>Information Collected by Cookies and Other Tracking Technologies</strong>: We use various technologies to collect information, and this may include sending cookies to your computer. Cookies are small data files stored on your hard drive or in your device memory that helps us to improve our services and your experience, see which areas and features of our services are popular and count visits. We may also collect information using web beacons (also known as &#8220;tracking pixels&#8221;). Web beacons are electronic images that may be used in our services or emails and to track count visits or understand usage and campaign effectiveness.</li>
	</ul>

	<p>For more details about how we collect information, including details about cookies and how to disable them, please see &#8220;Your Information Choices&#8221; below.</p>

	<h3>Information We Collect From Other Sources</h3>

	<p>In order to provide you with access to the Service, or to provide you with better service in general, we may combine information obtained from other sources (for example, a third-party service whose application you have authorized or used to sign in) and combine that with information we collect through our services.</p>

	<h2>Use of Information</h2>

	<p>We use information about you for various purposes, including to:</p>

	<ul>
	<li>Provide, maintain and improve our services;</li>
	<li>Provide services you request, process transactions and to send you related information;</li>
	<li>Send you technical notices, updates, security alerts and support and administrative messages;</li>
	<li>Respond to your comments, questions and requests and provide customer service;</li>
	<li>Communicate with you about news and information related to our service;</li>
	<li>Monitor and analyze trends, usage and activities in connection with our services; and</li>
	<li>Personalize and improve our services.</li>
	</ul>

	<p>By accessing and using our services, you consent to the processing and transfer of your information in and to the United States and other countries.</p>

	<h2>Sharing of Information</h2>

	<p>We may share personal information about you as follows:</p>

	<ul>
	<li>If we believe disclosure is reasonably necessary to comply with any applicable law, regulation, legal process or governmental request;</li>
	<li>To enforce applicable user agreements or policies, including our Terms of Service <strong>[URL FOR TERMS OF SERVICE]</strong>; and to protect us, our users or the public from harm or illegal activities;</li>
	<li>In connection with any merger, sale of PURPLAPP assets, financing or acquisition of all or a portion of our business to another company; and</li>
	<li>If we notify you through our services (or in our privacy policy) that the information you provide will be shared in a particular manner and you provide such information.</li>
	</ul>

	<p>We may also share aggregated or anonymized information that does not directly identify you.</p>

	<h2>Third Party Analytics</h2>

	<p>We may allow third parties to provide analytics services. These third parties may use cookies, web beacons and other technologies to collect information about your use of the services and other websites, including your IP address, web browser, pages viewed, time spent on pages, links clicked and conversion information. This information may be used by us and third parties to, among other things, analyze and track data, determine the popularity of certain content and other websites and better understand your online activity. Our privacy policy does not apply to, and we are not responsible for, third party cookies, web beacons or other tracking technologies and we encourage you to check the privacy policies of these third parties to learn more about their privacy practices.</p>

	<h2>Security</h2>

	<p>We take reasonable measures to help protect personal information from loss, theft, misuse and unauthorized access, disclosure, alteration and destruction.</p>

	<h2>Your Information Choices</h2>

	<h3>Location Information</h3>

	<p>Purplapp collects no information data.</p>

	<h3>Cookies</h3>

	<p>Most web browsers are set to accept cookies by default. If you prefer, you can usually choose to set your browser to remove or reject browser cookies. Please note that if you choose to remove or reject cookies, this could affect the availability and functionality of our services.</p>

	<h3>Promotional Communications</h3>

	<p>You may opt out of receiving any promotional emails from us by following the instructions in those emails. If you opt out, we may still send you non-promotional communications, such as those about your account or our ongoing business relations.</p>

	<h3>Your California Privacy Rights</h3>

	<p>California law permits residents of California to request certain details about how their information is shared with third parties for direct marketing purposes. If you are a California resident and would like to make such a request, please contact us at <strong>support@purplapp.eu</strong>. However, please note that under the law, Services such as ours that permit California residents to opt in to, or opt out of, this type of sharing are not required to provide such information upon receiving a request, but rather may respond by notifying the user of his or her right to prevent the disclosure. To opt out of having information about you shared with third parties for direct marketing purposes, please contact support via <strong>support@purplapp.eu</strong></p>

	<h2>Contact Us</h2>

	<p>If you have any questions about this privacy policy, please contact us at: <strong>support@purplapp.eu</strong></p>
</div>

<?php
  }
  include('../include/footer.php');
?>