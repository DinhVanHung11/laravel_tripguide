@php
use App\Http\Services\AttributeService;

$attrService = new AttributeService;
$features = $attrService->getAttributeValue('feature');
@endphp

<div id="modal-advance-room" class="modal modal-advance-room modal-advance">
    <h3 class="mb-5">Advance Room Setting</h3>
    <a href="#close-modal" rel="modal:close" class="close-modal-custom" id="no-save-advance">
        x
    </a>
    <div class="row">
        <div class="col-md-6">
            <span href="#" class="mb-4 btn btn-secondary" id="add-room-option">Add Option</span>
        </div>
        <div class="text-right col-md-6">
            <a href="#close-modal" rel="modal:close" class="btn btn-primary" id="save-advance">Save</a>
        </div>
    </div>
    <form action="{{ route('admin.hotel.store') }}" class="advance-options-form" method="POST">
        <table id="table-room-options" class="table table-add-options" class="table" border="1">
            <thead class="table-primary">
                <tr>
                    <th>Room Name</th>
                    <th>Price</th>
                    <th>Price Sale</th>
                    <th>Features</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($hotel) && count($hotel->rooms) >0 )
                    @foreach ( $hotel->rooms as $room )
                        <tr>
                            <td>
                                <input type="text"
                                    name="room_options[{{ $room->id }}][room_name]"
                                    value="{{ $room->room_name }}"
                                />
                            </td>
                            <td>
                                <input type="number"
                                    name="room_options[{{ $room->id }}][price]"
                                    value="{{ $room->price }}"
                                />
                            </td>
                            <td>
                                <input type="number"
                                    name="room_options[{{ $room->id }}][price_sale]"
                                    value="{{ $room->price_sale }}"
                                />
                            </td>
                            <td>
                                <select class="form-control features_select_choose" name="room_options[{{$room->id}}][room_features][]" multiple="multiple">
                                    @if (count($features) > 0)
                                        @foreach ( $features as $feature)
                                            <option value="{{ $feature->id }}"
                                                {{$room->features->contains('feature_id',$feature->id) ? 'selected' : ''}}
                                            >
                                                {{ $feature->label }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn-delete-option" id="delete-option-{{ $room->id }}">
                                    Delete
                                </a>
                            </td>
                            <input type="hidden" class="input-delete" name="room_options[{{ $room->id }}][delete]" value="0">
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @csrf
    </form>
</div>

<script>
    $('#add-room-option').on('click', () => {
        var tbody = $('#table-room-options tbody');
        var count = tbody.find('tr').length;

        tbody.append(`
            <tr class="new-option" id="new_option_${count}">
                <td>
                    <input type="text" name="room_options[option_${count}][room_name]"/>
                </td>
                <td>
                    <input type="number" name="room_options[option_${count}][price]"/>
                </td>
                <td>
                    <input type="number" name="room_options[option_${count}][price_sale]"/>
                </td>
                <td style="width: 30%">
                    <select class="form-control features_select_choose" name="room_options[option_${count}][room_features][]" multiple="multiple">
                        @if (count($features) > 0)
                            @foreach ( $features as $feature)
                                <option value="{{ $feature->id }}">{{ $feature->label }}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td>
                    <a href="javascript:void(0)" class="btn-delete-option" id="delete-option-${count}">Delete</a>
                </td>
                <input type="hidden" class="input-delete" name="room_options[option_${count}][delete]" value="0">
            </tr>
        `);
    });
</script>
