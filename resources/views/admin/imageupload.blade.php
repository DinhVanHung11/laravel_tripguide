<div class="image-show-item d-inline-block" data-id="{{$id}}" >
    <a href="{{$url}}" target="_blank">
        <img src="{{$url}}" alt="">
    </a>
    <span class="text-secondary delete-image" onclick="removeImageUpload({{$id}})">
        <i class="fa-solid fa-trash"></i>
    </span>
    <input type="hidden" name="image" value="{{$url}}">
</div>
