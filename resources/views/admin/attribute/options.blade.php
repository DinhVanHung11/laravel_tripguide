<h3>Manage Options (Values of Your Attribute)</h3>
<a href="#" class="mb-4 btn btn-secondary" id="add-attrbiute-option">Add Option</a>
<div class="row">
    <div class="col-md-9">
        <table id="table-attribute-options" class="table table-add-options" border="1">
            <thead class="table-primary">
                <tr>
                    <th>Option Label</th>
                    <th>Option Value</th>
                    <th>Image</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($attribute) && count($attribute->values) >0 )
                    @foreach ( $attribute->values as $option )
                        <tr class="" data-option-id="{{ $option->id }}">
                            <td>
                                <input type="text" name="attribute_values[{{ $option->id }}][label]" value="{{ $option->label }}"/>
                            </td>
                            <td>
                                <input type="text" name="attribute_values[{{ $option->id }}][value]" value="{{ $option->value }}"/>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input upload-table-image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                <div class="mt-2 feature-image-show">
                                    @if ($option->image)
                                        <div class="image-show-item d-inline-block" data-id="{{$option->id}}" >
                                            <a href="{{$option->image}}" target="_blank">
                                                <img src="{{$option->image}}" alt="">
                                            </a>
                                            <span class="text-secondary delete-image" onclick="removeImageUpload({{$option->id}})">
                                                <i class="fa-solid fa-trash"></i>
                                            </span>
                                            <input type="hidden" name="attribute_values[{{ $option->id }}][image]" value="{{$option->image}}">
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn-delete-option" id="delete-option-{{ $option->id }}">
                                    Delete
                                </a>
                            </td>
                            <input type="hidden" class="input-delete" name="attribute_values[{{ $option->id }}][delete]" value="0">
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
