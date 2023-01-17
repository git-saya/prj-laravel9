<div @class([
    'alert-danger' => $status == 'pending',
    'alert-success' => $status == 'complete'
])>
    A simple danger alert—check it out!
</div>