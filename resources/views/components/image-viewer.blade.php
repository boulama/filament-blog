<div>
    @if($getImage() && is_string($getImage()))
        <img src="{{ $getImage() }}" class="w-32 object-cover rounded-md border">
    @endif
</div>
