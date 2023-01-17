<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <input name="fullname"
        placeholder="Fullname"
        {{ $attributes->class(['form-control', 'is-invalid' => true])
        ->merge(['type' => 'text']) }} />
</div>
