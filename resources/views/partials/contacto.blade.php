<section id="contacto" class="contact-section">
    <div class="section-shell">
        <div class="contact-head">
            <h2>{{ __('site.contact.title') }}</h2>
            <p>{{ __('site.contact.body') }}</p>
        </div>

        <div class="contact-layout">
            <div class="contact-info">
                <div class="contact-card">
                    <div class="contact-card__icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="contact-card__text">
                        <h3>{{ __('site.contact.address') }}</h3>
                        <p><a href="https://maps.app.goo.gl/uckHMChf61RriQRr9" target="_blank">CV-700, Km36, 03787 Alpatró, La Vall de Gallinera<br>Alicante, España</a></p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card__icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="contact-card__text">
                        <h3>{{ __('site.contact.phone') }}</h3>
                        <p>+34 679 76 58 42</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card__icon"><i class="fa-regular fa-envelope"></i></div>
                    <div class="contact-card__text">
                        <h3>{{ __('site.contact.email') }}</h3>
                        <p><a href="mailto:agrivallcultius@gmail.com">agrivallcultius@gmail.com</a></p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form action="">
                    <h2>{{ __('site.contact.form_title') }}</h2>
                    <div class="input-box">
                        <input type="text" required>
                        <span>{{ __('site.contact.full_name') }}</span>
                    </div>
                    <div class="input-box">
                        <input type="text" required>
                        <span>{{ __('site.contact.email') }}</span>
                    </div>
                    <div class="input-box">
                        <textarea name="" id="" required></textarea>
                        <span>{{ __('site.contact.message') }}</span>
                    </div>
                    <div class="input-box">
                        <input type="submit" value="{{ __('site.contact.send') }}" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
