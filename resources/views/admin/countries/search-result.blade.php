@if (count($results) > 0)
    <ul class="bg-white result-list max-h-[200px] overflow-y-auto">
        @foreach ( $results as $result)
            <li class="flex items-center px-4 py-2 result-item gap-x-2" data-id="{{ $result->id }}">
                <svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6006 15.7088C14.9971 13.7615 15.952 11.6212 15.952 9.45493C15.952 5.58313 12.8274 2.44441 8.97297 2.44441C5.11859 2.44441 1.99399 5.58313 1.99399 9.45493C1.99399 11.6212 2.94881 13.7615 4.34538 15.7088C5.73141 17.6414 7.43574 19.2199 8.65083 20.2196C8.85015 20.3835 9.09579 20.3835 9.29512 20.2196C10.5102 19.2199 12.2145 17.6414 13.6006 15.7088ZM10.5586 21.7691C13.1351 19.6494 17.9459 14.9549 17.9459 9.45493C17.9459 4.4769 13.9286 0.441406 8.97297 0.441406C4.01734 0.441406 0 4.4769 0 9.45493C0 14.9549 4.81088 19.6494 7.38736 21.7691C8.32149 22.5377 9.62446 22.5377 10.5586 21.7691Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.97285 7.45174C7.8716 7.45174 6.97886 8.34851 6.97886 9.45474C6.97886 10.561 7.8716 11.4577 8.97285 11.4577C10.0741 11.4577 10.9668 10.561 10.9668 9.45474C10.9668 8.34851 10.0741 7.45174 8.97285 7.45174ZM4.98486 9.45474C4.98486 7.24228 6.77035 5.44873 8.97285 5.44873C11.1754 5.44873 12.9608 7.24228 12.9608 9.45474C12.9608 11.6672 11.1754 13.4608 8.97285 13.4608C6.77035 13.4608 4.98486 11.6672 4.98486 9.45474Z" fill="currentColor"/>
                </svg>
                <span class="result-text">
                    {{ $result->name }}
                </span>
            </li>
        @endforeach
    </ul>
@endif
