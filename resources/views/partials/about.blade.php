<section id="sobre-nosotros" class="about-story">
    <div class="about-media">
        <img src="{{ asset('imgs/apricotHandBright.jpg') }}" alt="{{ __('site.about.image_alt') }}">
    </div>

    <div class="about-overlay">
        <div class="about-shell">
            <div class="about-content about-reveal">
                <h2>{{ __('site.about.title') }}</h2>
                <p>
                    {{ __('site.about.body') }}
                </p>
            </div>
        </div>
    </div>
</section>
<section id="vision-mission" class="vision-mission">
    <div class="vision-mission-media">
        <img src="{{ asset('imgs/walnut.jpg') }}" alt="{{ __('site.about.walnut_alt') }}">
    </div>
    <div class="vision-mission-overlay">
        <div class="vision-mission-shell">
            <div class="vision-mission-content">
                <article class="pillar-card pillar-reveal">
                    <h3>{{ __('site.about.vision_title') }}</h3>
                    <p>{{ __('site.about.vision_body') }}</p>
                </article>

                <article class="pillar-card pillar-reveal">
                    <h3>{{ __('site.about.mission_title') }}</h3>
                    <p>{{ __('site.about.mission_body') }}</p>
                </article>
            </div>
        </div>
    </div>
</section>
