@extends('layouts.app')

@section('content')
<div class="help">
				<div class="help__grid">
					<div class="help__col help__col_2">
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">What is Comicats?</div>
								<div class="help-block__responce">Comicats is show and tell for comic creators. A community answering the question. comic creators, illustrators and
									other creative types share up their works and current projects. Comicats is also a place where people promote their
									work and products.</div>
							</div>
						</div>
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">How does blocking work?</div>
								<div class="help-block__responce">You can block another Comicats user by adding his username on the Blocking tab in Settings page and clicking Add
									button”. After blocking a user, the blocked user will not be able to follow you, subscribe your works and leave
									comments.</div>
							</div>
						</div>
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">I signed up for Comicats but I didn’t receive the confirmation email.</div>
								<div class="help-block__responce">If you don’t see the confirmation email, make sure to check your Spam folder and, if you’re using Gmail, please check
									the Social and Promotions folders.Contact us if you don’t find it there.</div>
							</div>
						</div>
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">I can’t remember my password for signing in. How do I reset it?</div>
								<div class="help-block__responce">If you can’t remember your password, you can use the ‘Forgot?’ link next to ‘Password’ on the Sign In page to reset
									it. Be sure to enter the same email address as the one you have registered with Comicats.</div>
							</div>
						</div>
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">I can’t sign in after resetting my password.</div>
								<div class="help-block__responce">Be sure you’re using the same email address that you used to reset when signing in to your account. Also, note that
									passwords are case-sensitive; make sure there are no extra spaces in the password field when you try to sign in.Contact
									us if you continue to have trouble.</div>
							</div>
						</div>
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">Can I have a username that is already taken?</div>
								<div class="help-block__responce">Perhaps. Inactive Comicats accounts may be renamed or removed at our discretion. We will not rename or remove an
									active account except in the case of name squatting, which is prohibited. You can request a username for an account
									that appears inactive, but please note that not all activity on Comicats is publicly visible.Attempts to buy, sell,
									or solicit other forms of payment in exchange for Comicats accounts or usernames are prohibited and may result in
									account suspension or removal.</div>
							</div>
						</div>
						<div class="help__help-block">
							<div class="help-block">
								<div class="help-block__question">How do I upload my work?</div>
								<div class="help-block__responce">Anyone can sign up to find or follow comic creators at Comicats. If you want to add your own work, click on the button
									Upload in main header menu, or button in your profile.</div>
							</div>
						</div>
					</div>
					<div class="help__col help__col_1">
						<div class="help__title">
							<h2 class="title title_theme_header">About Help Center</h2>
						</div>
						<div class="help__contacts">
							<svg class="help__i-help"><use xlink:href="/images/icon.svg#icon_help"></use></svg>Welcome to Comicats Help Center, where you’ll find
							answers to commonly asked questions. Before emailing us, take a look through, as the help you need is likely already
							here waiting for you.</div>
						<div class="help__emails">
							<div class="help__title">
								<h2 class="title title_theme_header">Contact Us</h2>
							</div>
							<a href="/contact" class="button button_theme_bubble-gum-link">
								<span class="button__text">
									<svg class="button__i-email"><use xlink:href="/images/icon.svg#icon_email"></use></svg>Email Support</span>
							</a>
						</div>
					</div>
				</div>
			</div>
@endsection