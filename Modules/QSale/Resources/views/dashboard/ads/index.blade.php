@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.ads.routes.index'))
@section('content')
<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <a href="#">{{__('qsale::dashboard.ads.routes.index')}}</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="portlet light bordered">

          @permission('add_ads')
          <div class="table-toolbar">
            <div class="row">
              <div class="col-md-6">
                <div class="btn-group">
                  <a href="{{ url(route('dashboard.ads.create')) }}"
                    class="btn sbold green">
                    <i class="fa fa-plus"></i> {{__('apps::dashboard.buttons.add_new')}}
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endpermission

          {{-- DATATABLE FILTER --}}
          <div class="row">
            <div class="portlet box grey-cascade">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>
                  {{__('apps::dashboard.datatable.search')}}
                </div>
                <div class="tools">
                  <a href="javascript:;"
                    class="collapse"
                    data-original-title=""
                    title=""> </a>
                </div>
              </div>
              <div class="portlet-body">
                <div id="filter_data_table">
                  <div class="panel-body">
                    <form id="formFilter"
                      class="horizontal-form">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">
                                {{__('apps::dashboard.datatable.form.date_range')}}
                              </label>
                              <div id="reportrange"
                                class="btn default form-control">
                                <i class="fa fa-calendar"></i> &nbsp;
                                <span> </span>
                                <b class="fa fa-angle-down"></b>
                                <input type="hidden"
                                  name="from">
                                <input type="hidden"
                                  name="to">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">
                                {{__('apps::dashboard.datatable.form.soft_deleted')}}
                              </label>
                              <div class="mt-radio-list">
                                <label class="mt-radio">
                                  {{__('apps::dashboard.datatable.form.delete_only')}}
                                  <input type="radio"
                                    value="only"
                                    name="deleted" />
                                  <span></span>
                                </label>
                                <label class="mt-radio">
                                  {{__('apps::dashboard.datatable.form.with_deleted')}}
                                  <input type="radio"
                                    value="with"
                                    name="deleted" />
                                  <span></span>
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="control-label">
                                {{ __('qsale::dashboard.ads.datatable.is_paid') }}
                              </label>
                              <div class="mt-radio-list">
                                <label class="mt-radio">
                                  {{__('apps::dashboard.datatable.yes')}}
                                  <input type="radio"
                                    value="1"
                                    name="is_paid" />
                                  <span></span>
                                </label>
                                <label class="mt-radio">
                                  {{__('apps::dashboard.datatable.no')}}
                                  <input type="radio"
                                    value="0"
                                    name="is_paid" />
                                  <span></span>
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="control-label">
                                {{__('apps::dashboard.datatable.form.status')}}
                              </label>
                              <div class="">
                                <select class="form-control"
                                  name="status">
                                  <option value="">{{__('apps::dashboard.datatable.all')}}</option>
                                  @foreach (Modules\QSale\Enum\AdsStatus::getConstList() as $type )
                                  <option value="{{$type}}">{{ __('qsale::dashboard.ads.datatable.status_enum.'.$type)
                                    }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="control-label">
                                {{ __('qsale::dashboard.ads.datatable.type') }}
                              </label>
                              <div class="">
                                <select class="form-control"
                                  name="type">
                                  <option value="">{{__('apps::dashboard.datatable.all')}}</option>
                                  @foreach (Modules\QSale\Enum\AdsType::getConstList() as $type )
                                  <option value="{{$type}}">{{ucfirst(str_replace("_", " ", $type))}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="control-label">
                                {{ __('qsale::dashboard.ads.datatable.user_type') }}
                              </label>
                              <div class="">
                                <select class="form-control"
                                  name="user_type">
                                  <option value="">{{__('apps::dashboard.datatable.all')}}</option>
                                  @foreach ( Modules\User\Enums\UserType::getConstList() as $type )
                                  @if($type != Modules\User\Enums\UserType::ADMIN )
                                  <option value="{{$type}}">{{ucfirst(str_replace("_", " ", $type))}}</option>
                                  @endif
                                  @endforeach
                                </select>
                              </div>
                            </div>

                          </div>

                        </div>
                      </div>
                    </form>
                    <div class="form-actions">
                      <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                        id="search">
                        <i class="fa fa-search"></i>
                        {{__('apps::dashboard.datatable.search')}}
                      </button>
                      <button class="btn btn-sm red btn-outline filter-cancel">
                        <i class="fa fa-times"></i>
                        {{__('apps::dashboard.datatable.reset')}}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- END DATATABLE FILTER --}}

          <div class="portlet-title">
            <div class="caption font-dark">
              <i class="icon-settings font-dark"></i>
              <span class="caption-subject bold uppercase">
                {{__('qsale::dashboard.ads.routes.index')}}
              </span>
            </div>
          </div>

          {{-- DATATABLE CONTENT --}}
          <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover"
              id="dataTable">
              <thead>
                <tr>
                  <th data-priority="1">
                    <a href="javascript:;"
                      onclick="CheckAll()">
                      {{__('apps::dashboard.buttons.select_all')}}
                    </a>
                  </th>
                  <th data-priority="1">#</th>
                  <th data-priority="1">{{__('qsale::dashboard.ads.datatable.image')}}</th>
                  <th data-priority="1">{{__('qsale::dashboard.ads.datatable.title')}}</th>
                  <th>{{__('qsale::dashboard.ads.datatable.description')}}</th>
                  <th data-priority="1">{{__('qsale::dashboard.ads.datatable.total')}}</th>

                  <th>{{__('qsale::dashboard.ads.datatable.status')}}</th>
                  <th>{{__('qsale::dashboard.ads.datatable.is_publish')}}</th>
                  <th>{{__('qsale::dashboard.ads.datatable.is_paid')}}</th>
                  <th>{{__('qsale::dashboard.ads.datatable.type')}}</th>
                  <th>{{__('qsale::dashboard.ads.datatable.start_at')}}</th>
                  <th>{{__('qsale::dashboard.ads.datatable.end_at')}}</th>


                  <th>{{__('qsale::dashboard.ads.datatable.created_at')}}</th>
                  <th data-priority="1">{{__('qsale::dashboard.ads.datatable.options')}}</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="row">
            <div class="form-group">
              <button type="submit"
                id="deleteChecked"
                class="btn red btn-sm"
                onclick="deleteAllChecked('{{ url(route('dashboard.ads.deletes')) }}')">
                {{__('apps::dashboard.datatable.delete_all_btn')}}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script>
  function tableGenerate(data='') {

      var dataTable =
      $('#dataTable').DataTable({
        "createdRow": function( row, data, dataIndex ) {
             if ( data["deleted_at"] != null ) {
                $(row).addClass('danger');
             }

          },
          ajax : {
              url   : "{{ url(route('dashboard.ads.datatable')) }}",
              type  : "GET",
              data  : {
                  req : data,
              },
          },
          language: {
              url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
          },
          stateSave: true,
          processing: true,
          serverSide: true,
          responsive: !0,
          order     : [[ 1 , "desc" ]],
          columns: [
            {data: 'id' 		 	        , className: 'dt-center'},
      		{data: 'id' 		 	        , className: 'dt-center'},
            { data: "image" ,orderable: false , width: "1%",
              render: function(data, type, row){
                return '<img src="'+data+'" width="50px"/>'
              }
            },
            {data: 'title' 	        , className: 'dt-center'},
            {data: 'description' 	        , className: 'dt-center'},
            {data: 'total' 	        , className: 'dt-center'},
            {data:"status" , className: 'dt-center'},
            { data: "is_publish" ,orderable: false , width: "1%",
              render: function(data, type, row){
                if (data == 1) {
                  return '<span class="badge badge-warning"> {{__('apps::dashboard.datatable.yes')}} </span>';
                }else{
                  return '<span class="badge badge-danger"> {{__('apps::dashboard.datatable.no')}} </span>';
                }

              }
            },
            { data: "is_paid" ,orderable: false , width: "1%",
              render: function(data, type, row){
                if (data == 1) {
                  return '<span class="badge badge-success"> {{__('apps::dashboard.datatable.yes')}} </span>';
                }else{
                  return '<span class="badge badge-danger"> {{__('apps::dashboard.datatable.no')}} </span>';
                }

              }
            },
            { data: "type" ,orderable: false , width: "1%",
              render: function(data, type, row){
                return `<span class="badge badge-info"> ${data}</span>`
              }
            },
            {data: 'start_at' 	        , className: 'dt-center'},
            {data: 'end_at' 	        , className: 'dt-center'},
            {data: 'created_at' 		  , className: 'dt-center'},

            {data: 'id'},
      		],
          columnDefs: [
            {
      				targets: 0,
      				width: '30px',
      				className: 'dt-center',
      				orderable: false,
      				render: function(data, type, full, meta) {
      					return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="`+data+` class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
      				},
      			},
            {
      				targets: 6,
      				width: '30px',
      				className: 'dt-center',
      				render: function(data, type, full, meta) {
                        return `<span class="badge badge-primary"> ${data} </span>`;
      				},
      			},
            {
              targets: -1,
              responsivePriority:1,
              width: '13%',
              title: '{{__('qsale::dashboard.ads.datatable.options')}}',
              className: 'dt-center',
              orderable: false,
              render: function(data, type, full, meta) {
                // Edit
      					var editUrl = '{{ route("dashboard.ads.edit", ":id") }}';
      					editUrl = editUrl.replace(':id', data);

                          var showUrl = '{{ route("dashboard.ads.show", ":id") }}';
      					showUrl = showUrl.replace(':id', data);

      					// Delete
      					var deleteUrl = '{{ route("dashboard.ads.destroy", ":id") }}';
      					deleteUrl = deleteUrl.replace(':id', data);

      					return `
                          <a href="`+showUrl+`" class="btn btn-sm yellow" title="Shpw">
      			              <i class="fa fa-eye"></i>
      			            </a>
                @permission('edit_ads')
      						<a href="`+editUrl+`" class="btn btn-sm blue" title="Edit">
      			              <i class="fa fa-edit"></i>
      			            </a>
      					@endpermission

                @permission('delete_ads')
                @csrf
                  <a href="javascript:;" onclick="deleteRow('`+deleteUrl+`')" class="btn btn-sm red">
                    <i class="fa fa-trash"></i>
                  </a>
                @endpermission

                `;


              },
            },
            {
              targets: -2,
              width: '13%',
              title: '{{__('qsale::dashboard.ads.datatable.options')}}',
              className: 'dt-center',
              orderable: false,
              render: function(data, type, full, meta) {
                 let      id=full['id']
			        	addAdditionUrl =
                  '{{ route('dashboard.ads.add.additions',['ads'=>':ads']) }}'.replace(':ads', id);
				        editAdditionUrl =
                  '{{ route('dashboard.ads.edit.additions',['ads'=>':ads']) }}'.replace(':ads', id);


      					return `
                @permission('edit_ads')
                  <a href="`+addAdditionUrl+`"
                    class="btn btn-sm blue"
                    title="Edit">
                       add additions
                  </a>
                  <a href="`+editAdditionUrl+`"
                    class="btn btn-sm blue"
                    title="Edit">
                     edit additions
                  </a>
                  @endpermission
                `;


              },
            },
          ],
          dom: 'Bfrtip',
          lengthMenu: [
              [ 10, 25, 50 , 100 , 500 ],
              [ '10', '25', '50', '100' , '500']
          ],
  				buttons:[
  					{
    						extend: "pageLength",
                className: "btn blue btn-outline",
                text: "{{__('apps::dashboard.datatable.pageLength')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5, 6]
                }
  					},
  					{
    						extend: "print",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::dashboard.datatable.print')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5, 6]
                }
  					},
  					{
  							extend: "pdf",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::dashboard.datatable.pdf')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5, 6]
                }
  					},
  					{
  							extend: "excel",
                className: "btn blue btn-outline " ,
                text: "{{__('apps::dashboard.datatable.excel')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5, 6]
                }
  					},
  					{
  							extend: "colvis",
                className: "btn blue btn-outline",
                text: "{{__('apps::dashboard.datatable.colvis')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5, 6]
                }
  					}
  				]
      });
  }

  jQuery(document).ready(function() {
  	tableGenerate();
  });
</script>
@stop
