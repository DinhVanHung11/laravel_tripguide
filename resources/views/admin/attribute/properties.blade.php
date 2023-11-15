@php
use \App\Models\Attribute;

$attributeModel = new Attribute;
@endphp

<h3>Attribute Properties</h3>
<div class="mb-2 form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="enable" name="active" checked>
    <label class="form-check-label" for="enable">Enable</label>
</div>
<div class="form-group">
    <label for="">Default Label</label>
    <input type="text" class="form-control" placeholder="Enter label" name="label" value="{{ isset($attribute) ?$attribute->label : '' }}">
</div>
<div class="form-group">
    <label for="">Attribute Type</label>
    <select class="form-select" aria-label="Default select example" name="type">
        <option value="{{ $attributeModel::ONESELECT  }}"
            {{ isset($attribute) && $attribute->type == $attributeModel::ONESELECT ? 'selected' : ''}}
        >
            ONE SELECTED
        </option>
        <option value="{{ $attributeModel::MULTISELECT }}"
            {{ isset($attribute) && $attribute->type == $attributeModel::MULTISELECT ? 'selected' : ''}}
        >
            MULTIPLE SELECTED
        </option>
    </select>
</div>
<div class="form-group">
    <label for="">Attribute Code</label>
    <input type="text" class="form-control" placeholder="Enter label" name="attribute_code" value="{{ isset($attribute) ?$attribute->attribute_code : '' }}">
</div>
