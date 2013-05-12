<?php
require_once('edit.php');
require_once('function.php');
?>
<?php include_once('header.php'); ?>
		<div class="wrapper">
			<header>
				<ul class="social-icons">
					<li class="gplus"><a href="#" title="Google Plus">gplus</a></li>
					<li class="twitter"><a href="#" title="Twitter">twitter</a></li>
					<li class="facebook"><a href="#" title="Facebook">facebook</a></li>
				</ul>
				<div class="logo"><img src="img/logo.png" alt="" title=""/></div>
			</header>
			<hr/>

			<article class="content">

				<div class="article-header">
					<h1><?php echo H1; ?></h1>
					<p><?php echo PARAGRAPH; ?></p>
				</div>

				<section class="counter" data-date="<?php echo COUNTDOWN; ?>"></section>

				<div class="article-footer">

                    <div class="error-msg err-newsletter">
                        <?php add_subscriber(); ?>
                    </div>

					<form class="newsletter-form" action="" method="post">
						<input class="subscribeto" type="text" name="newsletter" value="Keep you up to date by adding your e-mail address ..." onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />
						<input class="submit" type="submit" name="submit" value="newsletter" />
						<input type="hidden" name="submit" value="true" />
					</form>

					<div class="contact-form">
                    	<h3 class="js" title="Send us a message!">Don’t count the time, contact us now.<span class="mail-icon mail-icon-close"></span></h3>
                        <div class="trigger">

                        	<div class="error-msg err-contactform">
								<?php process_contact_form(); ?>
                            </div>

                            <form action="function.php" method="post">
                                <textarea name="message" id="message" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;">message</textarea>
                                <input type="text" name="name" id="name" value="name" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />
                                <input type="text" name="email" id="email" value="email" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />
                                <input class="send" type="submit" name="send" value="send" />
                                <input type="hidden" name="send" value="true" />
                            </form>
                        </div>
					</div>
                    <hr class="bottom-style"/>
				</div>

			</article>

			<footer class="main">
				<hr/>
				<p>© Copyright 2012 by Istvan Nonn</p>
			</footer>
		</div>

<?php include_once('footer.php'); ?>