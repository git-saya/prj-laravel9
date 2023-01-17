@props([
    'title',
    'footer',
])

<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    <div style="width: 18rem" {{ $attributes->class(['card']) }}>
        <img class="card-img-top" src="{{ asset('images/card.svg') }}" alt="Card image cap">
        <div class="card-body">
            <h5 {{ $title->attributes->class(['card-title']) }}>{{ $title }}</h5>
            <p class="card-text">{{ $slot }}</p>
            <div {{ $footer->attributes->class(['card-footer'])  }}>
                {{ $footer }}
            </div>
        </div>
    </div>
</div>