@extends('layouts.app')

@section('content')
    <div class="contact">
        <div class="contact__content">
            <div class="contact__title">
                <h2 class="title title_theme_header">Contact Us</h2>
            </div>
            <div class="contact__description">
                <p class="description description_theme_header">Have any questions or suggestions?</p>
            </div>
            <div class="contact__separator"></div>
            <div class="contact__grid">
                <div class="contact__form">
                    <div class="contact__select">
                        <div class="select select_theme_light select_font_l" id="contact-topic">
                            <select style="width: 100%" class="select__select-hidden">
                                <option value="" class="select__option-hidden"></option>
                                <option value="General Support / Feedback" class="select__option-hidden">General Support / Feedback</option>
                                <option value="Copyright / Trademark Violations" class="select__option-hidden">Copyright / Trademark Violations</option>
                                <option value="Business Inquiries" class="select__option-hidden">Business Inquiries</option>
                                <option value="Other" class="select__option-hidden">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="contact__field">
                        <div class="field">
                            <input type="text" value="" placeholder="Full Name" class="field__input" />
                        </div>
                    </div>
                    <div class="contact__field">
                        <div class="field">
                            <input type="text" value="" placeholder="Email Address" class="field__input" />
                        </div>
                    </div>
                    <div class="contact__field">
                        <div class="field">
                            <input type="text" value="" placeholder="Subject" class="field__input" />
                        </div>
                    </div>
                    <div class="contact__textarea">
                        <textarea placeholder="Message" class="textarea textarea_font_l"></textarea>
                    </div>
                    <a href="#" class="button button button_theme_bubble-gum button_size_l">Send Message</a>
                </div>
                <div class="contact__contacts">
                    <div class="contact__title">
                        <h2 class="title title_theme_comic">Mailing Address</h2>
                    </div>
                    <div class="contact__address">
                        <div class="contact__company">Comicats Ltd.</div>
                        <div class="contact__street">Kurchatova Str, 8 -</div>
                        <div class="contact__country">212000, Minsk, BELARUS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection