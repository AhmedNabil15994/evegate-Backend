<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="caption">
        <i class="fa fa-refresh" aria-hidden="true" wire:click="getTheContent" ></i>
        <span class="caption-subject font-blue bold uppercase">
            {{ __('apps::dashboard.index.statistics.'.$type) }}
        </span>
        <div>
            <select wire:change="setTake($event.target.value)">
                @foreach (range(10,50,10) as $value)       
                       <option @if($take == $value) selected @endif>{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                
                    <th>#</th>
                    <th>{{ __('apps::dashboard.index.statistics.purchase') }}</th>
                    <th>{{ __('apps::dashboard.index.statistics.section') }}</th>
                    <th>{{__('wallet::dashboard.saleBoxs.datatable.number')}}</th>
                    <th>{{__('wallet::dashboard.saleBoxs.datatable.price')}}</th>
                  
                    <th>{{__('wallet::dashboard.saleBoxs.datatable.benfit')}}</th>
                    <th>{{__('wallet::dashboard.saleBoxs.datatable.user_id')}}</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $operation)
                    <tr>
                        <td>{{$operation->id}}</td>
                        <td>{{$operation->purchase->translateOrDefault(locale())->title}}</td>
                        <td>{{$operation->section->translateOrDefault(locale())->title}}</td>
                        <td>{{$operation->number}}</td>
                        <td>{{$operation->price}}</td>
                        <td>{{$operation->benfit}}</td>
                        <td>{{$operation->user->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
