<div id="modal-advance-price" class="modal modal-advance-price modal-advance {{ isset($hotel) && count($hotel->advancePrices) >0 ? 'has-options' : ''}}">
    <h3 class="mb-5">Advance Price Setting</h3>
    <a href="#close-modal" rel="modal:close" class="close-modal-custom" id="no-save-advance">
        x
    </a>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="mb-4 btn btn-secondary" id="add-price-option">Add Option</a>
        </div>
        <div class="text-right col-md-6">
            <a href="#close-modal" rel="modal:close" class="btn btn-primary" id="save-advance">Save</a>
        </div>
    </div>
    <form action="{{ route('admin.hotel.store') }}" class="advance-options-form" method="POST">
        <table id="table-price-options" class="table table-add-options " class="table" border="1">
            <thead class="table-primary">
                <tr>
                    <th>Price</th>
                    <th>Price Sale</th>
                    <th>Number of people</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($hotel) && count($hotel->advancePrices) >0 )
                    @foreach ( $hotel->advancePrices as $optionPrice )
                        <tr>
                            <td>
                                <input type="text"
                                    name="price_options[{{ $optionPrice->id }}][price]"
                                    value="{{ $optionPrice->price }}"
                                />
                            </td>
                            <td>
                                <input type="text"
                                    name="price_options[{{ $optionPrice->id }}][price_sale]"
                                    value="{{ $optionPrice->price_sale }}"
                                />
                            </td>
                            <td>
                                <input type="number"
                                    name="price_options[{{ $optionPrice->id }}][people]"
                                    value="{{ $optionPrice->number_people }}"
                                />
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn-delete-option" id="delete-option-{{ $optionPrice->id }}">
                                    Delete
                                </a>
                            </td>
                            <input type="hidden" class="input-delete" name="price_options[{{ $optionPrice->id }}][delete]" value="0">
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @csrf
    </form>
</div>
